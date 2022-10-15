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
use Illuminate\Support\Facades\Session;

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
        $this->data['labels'] = ['A','B','C','D'];
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
            if($quiz->score != null){
                $quiz_taken = true;
            } else {
                $last_seen = strtotime($quiz->created_at);
                if((time() - $last_seen) > $duration){
                    $quiz_taken = true;
                    if($quiz->remarks == null){
                        $quiz->remarks = 'You missed your exam.';
                        $quiz->score = '0';
                        $quiz->save();
                    }

                } else {
                    $quiz_taken = false;
                }
            }

        }
        $data['quiz_taken'] = $quiz_taken;

       return view('exam.start', $data);
    }

    public function start_quiz()
    {
        $data = $this->data;
        $setting = Setting::first();
        $data['page_title'] = 'Start Exam';
        $id = session()->get('applicant')->id;
        $quiz = Application::where('applicant_id', $id)->first();
        if($quiz){
            if($quiz->score != null){
                return redirect()->route('dashboard');
            }
            $last_seen = strtotime($quiz->created_at);
            $time_spent = time() - $last_seen;
            $duration = $setting->exam_duration - $time_spent;
        }
        else {
            $quiz = new Application();
            $quiz->applicant_id = $id;

            $generated = $this->selectExamQuestions();

            $questions = $generated[0];
            $quiz->questions = json_encode($questions);
            $quiz->total_questions = $generated[1];
            $quiz->correct_answers = $generated[2];

            $quiz->save();

            $duration = $setting->exam_duration;

        }

        $categories = $this->arrangeQuestionIds($quiz->questions);

        $data['exam'] = $quiz;
        $data['categories'] = $categories;
        $data['duration'] = $duration;
        $data['essay'] = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae consequatur debitis eaque illo inventore ipsum magni molestiae nulla optio placeat quam qui quo quod reprehenderit, soluta, veritatis vitae? Alias, nihil.';
        return view('exam.quiz', $data);
    }

    public function submit_quiz(Request $request)
    {
        $request->validate([
            'exam_id' => 'required',
        ]);

        $user = session()->get('applicant')->id;
        $exam = Application::whereId($request->exam_id)->where('applicant_id', $user)->firstOrFail();

        $total_questions = $exam->total_questions;


        $answers = [];
        for($i = 0; $i < $total_questions; $i++){
            if($request->has('answers-' . $i)){
                $answer = $request->input('answers-' . $i);
            } else {
                $answer = '-';
            }

            array_push($answers, $answer);
        }

        $exam->answers = implode(",", $answers);
        $score = $this->scoreExam($answers, $exam->correct_answers);
        $exam->score = $score;
        $exam->save();

        return redirect()->route('dashboard')->with('message', 'You have completed your exam');
    }

    private function scoreExam($answers, $correct_answers)
    {
        $correct_answers = explode(",", $correct_answers);
        $total_questions = count($correct_answers);
        $passed = 0;
        foreach ($correct_answers as $i => $correct){
            if($correct == $answers[$i]){
                $passed++;
            }
        }
        $score = ($passed / $total_questions) * 100;
        return $score;
    }

    private function selectExamQuestions()
    {
        $categories = Category::all();

        $setting = Setting::first();

        $pool = [];
        $total_questions = 0;
        $correct_answers = [];
        foreach($categories as $category){
            $questions = Question::where('category_id', $category->id)
                ->inRandomOrder()->limit($setting->category_questions)->get();

            $ids = [];
            foreach ($questions as $question){
                $total_questions++;
                array_push($ids, $question->id);
                array_push($correct_answers, $question->answer);
            }

            array_push($pool, [
                'category' => $category->name,
                'cat_id' => $category->id,
                'questions' => implode(",", $ids)
            ]);
        }

        return [$pool, $total_questions, implode(",",$correct_answers)];
    }

    private function arrangeQuestionIds($pool)
    {
        $arr = [];
        $questions = json_decode($pool);
        foreach($questions as $item){
            if(strlen($item->questions) != 0){
                $a = [
                    'category' => $item->category,
                    'questions' => $this->sortQuestions($item->questions)
                ];
                array_push($arr, $a);
            }

        }

        return $arr;
    }

    private function sortQuestions($ids)
    {
        $ids = explode(",", $ids);
        $questions = Question::whereIn('id', $ids)->get();
        $qs = [];
        foreach($ids as $id){
            foreach ($questions as $question){
                if($question->id == $id){
                    array_push($qs, $question);
                    break;
                }
            }
        }
        return $qs;
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('quiz.login');
    }
}
