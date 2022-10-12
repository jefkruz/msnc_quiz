<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Application;
use App\Models\Category;
use App\Models\Department;
use App\Models\Job;
use App\Models\Question;
use App\Models\Rank;
use App\Models\Region;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //

    protected $data;

    public function __construct()
    {
        $this->data['roles'] = Role::all();
        $this->data['ranks'] = Rank::all();
        $this->data['departments'] = Department::all();
        $this->data['applicants'] = Applicant::all();
        $this->data['jobs'] = Job::all();
        $this->data['regions'] = Region::all();
        $this->data['zones'] = Zone::all();
        $this->data['categories'] = Category::all();
        $this->data['questions'] = Question::all();
    }

    public function show_register($rank)
    {

        if(session('applicant')){
            return redirect()->route('dashboard');
        }
        $data = $this->data;
        $rank = Rank::where('name', $rank)->firstOrFail();
        $rankname=  $rank->id;

        $data['rankname'] = $rankname;
        $data['page_title'] = 'Register';

        return view('applicant.register', $data);
    }

    public function fetchzones(Request $request)
    {
        $data['zones'] = Zone::where('region_id',$request->region)->get(["name", "id"]);

        return response()->json($data);
    }

    public function register(Request $request)
    {
        request()->validate(Applicant::$rules);
        $applicant = Applicant::create($request->all());
        session()->put('applicant',$applicant);
        return redirect(route('dashboard'));
    }
    public function show_login()
    {
        if(session('applicant')){
            return redirect()->route('dashboard');
        }
        $data['page_title'] = 'Login';
        return view('applicant.login', $data);
    }

    public function login(Request $request)
    {
        //VALIDATE CREDENTIALS

        $request->validate([
            'email' => 'required|email',

        ]);

        //VERIFY IF USERNAME AND PASSWORD MATCH
        $quiz = Applicant::where('email', $request->email)->first();

        if($quiz) {
            session()->put('applicant', $quiz);
            return redirect()->route('dashboard');
        }
        else {
            return redirect()->back()->withInput()->with('error', 'This Email is Not Registered ');
        }

    }

    public function home()
    {
        $data['page_title'] = 'Welcome';
        $id = session()->get('applicant')->id;
        $quiz = Application::where('applicant_id', $id)->first();
        $data['quiz'] = $quiz;
        $duration = Setting::first()->exam_duration;
        $hour = floor($duration / 3600);
        $minute = ($duration / 60) % 60;
        $data['display'] = ($hour > 0) ? $hour . ' hour(s) ' . $minute  . ' minute(s)' : $minute  . ' minute(s)';

        if(!$quiz){
            $quiz_taken = false;
        } else {
            $last_seen = strtotime($quiz->created_at);
            if((time() - $last_seen) > $duration){
                $quiz_taken = true;
            } else {
                $quiz_taken = false;
            }
        }
        $data['quiz_taken'] = $quiz_taken;

       return view('exam.start', $data);
    }

    public function start_quiz()
    {
        $setting = Setting::first();
        $data['page_title'] = 'Start Exam';
        $id = session()->get('applicant')->id;
        $quiz = Application::where('applicant_id', $id)->first();
        if($quiz){
            $questions = $this->selectExamQuestions($quiz->questions);
            $last_seen = strtotime($quiz->created_at);
            $time_spent = time() - $last_seen;
            $duration = $setting->exam_duration - $time_spent;
        }
        else {
            $quiz = new Application();
            $quiz->applicant_id = $id;

            $questions = $this->selectExamQuestions();

            $quiz->questions = json_encode($this->arrangeQuestionIds($questions));

            $quiz->save();

            $duration = $setting->exam_duration;

        }

        // return $questions;

        $data['categories'] = $questions;
        $data['duration'] = $duration;
        $data['essay'] = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae consequatur debitis eaque illo inventore ipsum magni molestiae nulla optio placeat quam qui quo quod reprehenderit, soluta, veritatis vitae? Alias, nihil.';
        return view('exam.quiz', $data);
    }

    private function selectExamQuestions($questions = null)
    {
        $categories = Category::all();
        if($questions != null){
            $q = json_decode($questions, true);
            $pool = [];
            foreach($q as $category){
                $a = [];
                foreach($categories as $c){
                    if($c->id == $category['cat_id']){
                        $a['category'] = $c->name;
                        $a['cat_id'] = $c->id;

                        $ques = Question::whereIn('id', $category[$c->name])
                   ->get();
                   $payload = [];
                   foreach($category[$c->name] as $p){
                    foreach($ques as $qui){
                        if($qui->id == $p){
                            array_push($payload, $qui);
                            break;
                        }
                    }
                   }
                        $a['questions'] = $payload;
                        break;
                    }

                    array_push($pool, $a);
                }
                
               
                array_push($pool, $a);
            }

            return $pool;
        }

        $setting = Setting::first();

        $pool = [];
        foreach($categories as $category){
            $questions = Question::where('category_id', $category->id)
                ->inRandomOrder()->limit($setting->category_questions)->get();

            array_push($pool, [
                'category' => $category->name,
                'cat_id' => $category->id,
                'questions' => $questions
            ]);
        }

        return $pool;
    }

    private function arrangeQuestionIds($pool)
    {
        $arr = [];
        foreach($pool as $item){
            $a = [];
            $q_pool = [];
            foreach($item['questions'] as $q){
                array_push($q_pool, $q['id']);
            }
            $a[$item['category']] = $q_pool;
            $a['cat_id'] = $item['cat_id'];
            array_push($arr, $a);
        }

        return $arr;
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('quiz.login');
    }
}
