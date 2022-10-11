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
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    protected $data;

    public function __construct()
    {
        $this->data['roles'] = Role::all();
        $this->data['ranks'] = Rank::all();
        $this->data['departments'] = Department::all();
        $this->data['users'] = User::all();
        $this->data['applicants'] = Applicant::all();
        $this->data['jobs'] = Job::all();
        $this->data['regions'] = Region::all();
        $this->data['zones'] = Zone::all();
        $this->data['categories'] = Category::all();
        $this->data['questions'] = Question::all();
        $this->middleware('role:admin');
    }


    public function index()
    {
        $data = $this->data;
        $data['page_title'] = 'Dashboard';
        return view('admin.home', $data);
    }

    public function settings()
    {
        $data = $this->data;
        $data['page_title'] = 'Settings';
        return view('admin.settings', $data);
    }
}
