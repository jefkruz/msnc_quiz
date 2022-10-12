<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZoneController;
use App\Http\Middleware\IsApplicant;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();


// -----------------------------APPLICANT LOGIN ROUTES----------------------------------------//

Route::get('register/{rank}',  [MainController::class, 'show_register'])->name('quiz.register');
Route::post('register/{rank}',  [MainController::class, 'register']);
Route::post('quiz/zones', [MainController::class, 'fetchzones']);
Route::get('login', [MainController::class, 'show_login'])->name('quiz.login');
Route::post('login', [MainController::class, 'login']);

// -----------------------------APPLICANT AUTH ROUTES----------------------------------------//


    Route::middleware([IsApplicant::class])->group(function () {
    Route::get('quiz', [MainController::class, 'home'])->name('dashboard');
    Route::get('start', [MainController::class, 'start_quiz'])->name('quiz.start');

    Route::get('logout', [MainController::class, 'logout'])->name('quiz.logout');



});



Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('home');
    Route::get('settings', [AdminController::class, 'settings'])->name('settings');
    Route::resource('ranks', RankController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('regions', RegionController::class);
    Route::resource('jobs', JobController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('zones', ZoneController::class);
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('questions', QuestionController::class);
    Route::resource('applicants', ApplicantController::class);

    /**
     *
     *
     * IMPORTATION ROUTES
     */

    // DEPARTMENT IMPORT ROUTES
    Route::post('departments/import', [DepartmentController::class, 'departments_import'])->name('departments.import');
    Route::get('department/template', [DepartmentController::class, 'departments_template'])->name('departments.template');

    // QUESTIONS IMPORT ROUTES
    Route::post('questions/import', [QuestionController::class, 'questions_import'])->name('questions.import');
    Route::get('question/template', [QuestionController::class, 'questions_template'])->name('questions.template');

});

Route::get('clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('storage:link');

    return "Cleared!";

});
