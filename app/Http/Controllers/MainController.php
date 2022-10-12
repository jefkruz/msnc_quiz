<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
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

        $data['quiz_taken'] = false;
        $duration = Setting::first()->exam_duration;
        $hour = floor($duration / 3600);
        $minute = ($duration / 60) % 60;
        $data['display'] = ($hour > 0) ? $hour . ' hour(s) ' . $minute  . ' minute(s)' : $minute  . ' minute(s)';
       return view('exam.start', $data);
    }

    public function start_quiz()
    {
        $setting = Setting::first();
        $data['page_title'] = 'Start Exam';
        $data['duration'] = $setting->exam_duration;
        $data['categories'] = ['Mathematics', 'English', 'Ministry and You'];
        $data['essay'] = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae consequatur debitis eaque illo inventore ipsum magni molestiae nulla optio placeat quam qui quo quod reprehenderit, soluta, veritatis vitae? Alias, nihil.';
        return view('exam.quiz', $data);
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('quiz.login');
    }
}
