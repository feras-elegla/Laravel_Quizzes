<?php

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
    return view('welcomes');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    //  --------------------Teacher ----------------------
    Route::group(['namespace' => 'Teacher', 'prefix' => 'Teacher', 'middleware' => 'TeacherMiddleware'], function () {
        Route::get('/index', [App\Http\Controllers\Teacher\TeacherController::class, 'index'])->name('teachers');
        Route::post('/store', [App\Http\Controllers\Teacher\TeacherController::class, 'store'])->name('teachers.store');
        Route::get('/create', [App\Http\Controllers\Teacher\TeacherController::class, 'create'])->name('teachers.create');
        Route::get('/delete/{id}', [App\Http\Controllers\Teacher\TeacherController::class, 'destroy'])->name('teachers.delete');
        Route::post('/update/{id}', [App\Http\Controllers\Teacher\TeacherController::class, 'update'])->name('teachers.update');
        Route::get('/edit/{id}', [App\Http\Controllers\Teacher\TeacherController::class, 'edit'])->name('teachers.edit');
        Route::get('/status/{id}', [App\Http\Controllers\Teacher\TeacherController::class, 'changeStatus'])->name('teachers.status');
        Route::post('/editProfile', [App\Http\Controllers\Teacher\TeacherController::class, 'editProfile'])->name('profiles.edit');
        Route::post('/Profile', [App\Http\Controllers\Teacher\TeacherController::class, 'Profile'])->name('profiles');



        //   -------------------------categoris ----------------------
        Route::group(['prefix' => 'Teacher_Student'], function () {
            Route::get('/index', [App\Http\Controllers\Teacher\StudentController::class, 'index'])->name('students');
            Route::post('/store', [App\Http\Controllers\Teacher\StudentController::class, 'store'])->name('students.store');
            Route::get('/create', [App\Http\Controllers\Teacher\StudentController::class, 'create'])->name('students.create');
            Route::get('/delete/{id}', [App\Http\Controllers\Teacher\StudentController::class, 'destroy'])->name('students.delete');
            Route::post('/update/{id}', [App\Http\Controllers\Teacher\StudentController::class, 'update'])->name('students.update');
            Route::get('/edit/{id}', [App\Http\Controllers\Teacher\StudentController::class, 'edit'])->name('students.edit');
            Route::get('/status/{id}', [App\Http\Controllers\Teacher\StudentController::class, 'changeStatus'])->name('students.status');

        });
        //----------------------------
        //   -------------------------categoris ----------------------
        Route::group(['prefix' => 'categoris'], function () {
            Route::get('/index', [App\Http\Controllers\Teacher\CategoryController::class, 'index'])->name('categoris');
            Route::post('/store', [App\Http\Controllers\Teacher\CategoryController::class, 'store'])->name('categoris.store');
            Route::get('/create', [App\Http\Controllers\Teacher\CategoryController::class, 'create'])->name('categoris.create');
            Route::get('/delete/{id}', [App\Http\Controllers\Teacher\CategoryController::class, 'destroy'])->name('categoris.delete');
            Route::post('/update/{id}', [App\Http\Controllers\Teacher\CategoryController::class, 'update'])->name('categoris.update');
            Route::get('/edit/{id}', [App\Http\Controllers\Teacher\CategoryController::class, 'edit'])->name('categoris.edit');
            Route::post('/getCategory', [App\Http\Controllers\Teacher\CategoryController::class, 'getCategory'])->name('categoris.getCategory');


        });
        //----------------------------
          //   -------------------------Question ----------------------
          Route::group(['prefix' => 'Question'], function () {
            Route::get('/index', [App\Http\Controllers\Teacher\QuestionController::class, 'index'])->name('questions');
            Route::post('/store', [App\Http\Controllers\Teacher\QuestionController::class, 'store'])->name('questions.store');
            Route::get('/create', [App\Http\Controllers\Teacher\QuestionController::class, 'create'])->name('questions.create');
            Route::get('/delete/{id}', [App\Http\Controllers\Teacher\QuestionController::class, 'destroy'])->name('questions.delete');
            Route::post('/update/{id}', [App\Http\Controllers\Teacher\QuestionController::class, 'update'])->name('questions.update');
            Route::get('/edit/{id}', [App\Http\Controllers\Teacher\QuestionController::class, 'edit'])->name('questions.edit');



        });
        //----------------------------


    });




    // -------------------------Student ---------------------------------
    Route::group(['namespace' => 'Student', 'prefix' => 'Student', 'middleware' => 'StudentMiddleware'], function () {
//   -------------------------Question ----------------------
Route::group(['prefix' => 'Quizzes'], function () {
    Route::get('/index', [App\Http\Controllers\Student\QuizzesController::class, 'index'])->name('quizzes');
    Route::post('/store', [App\Http\Controllers\Student\QuizzesController::class, 'store'])->name('quizzes.store');
    Route::get('/create', [App\Http\Controllers\Student\QuizzesController::class, 'create'])->name('quizzes.create');
    Route::get('/delete/{id}', [App\Http\Controllers\Student\QuizzesController::class, 'destroy'])->name('quizzes.delete');
    Route::post('/update/{id}', [App\Http\Controllers\Student\QuizzesController::class, 'update'])->name('quizzes.update');
    Route::get('/edit/{id}', [App\Http\Controllers\Student\QuizzesController::class, 'edit'])->name('quizzes.edit');
    Route::post('/getQuizzes', [App\Http\Controllers\Student\QuizzesController::class, 'getQuizzes'])->name('quizzes.getQuizzes');
    Route::get('/detailse/{id}', [App\Http\Controllers\Student\QuizzesController::class, 'detailse'])->name('questions.detailse');
    Route::get('/review/{id}', [App\Http\Controllers\Student\QuizzesController::class, 'review'])->name('questions.review');

});
//----------------------------
    });
});
