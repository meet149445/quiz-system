<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\UserController;


Route::get('/', [UserController::class, "welcome"]);
Route::get('user-quiz-list/{id}/{category}', [UserController::class, "userQuizList"]);
Route::get('start-quiz/{id}/{name}', [UserController::class, "startQuiz"]);
//Route::view('user-signup', "user-signup");
Route::post('user-signup', [UserController::class, "userSignup"]);
//Route::view('user-login', "user-login");
Route::post('user-login', [UserController::class, "userLogin"]);
Route::get('search-quiz', [UserController::class, "searchQuiz"]);
Route::get('verify-user/{email}', [UserController::class, "verifyUser"]);
Route::view('user-forgot-password', 'user-forgot-password');
Route::post('user-forgot-password', [UserController::class, 'userForgotPassword']);
Route::get('user-forgot-password/{email}', [UserController::class, "userResetForgotPassword"]);
Route::post('user-reset-password', [UserController::class, "userResetPass"]);
Route::get('categories-list', [UserController::class, "categories"]);

Route::get('certificate/view/{id}', [UserController::class, 'viewCertificate']);
Route::get('certificate/download/{id}', [UserController::class, 'downloadCertificate']);

Route::get('/blog', [UserController::class, 'blogs']);
Route::get('/blog/{id}', [UserController::class, 'blogDetail']);


Route::get('user-login',function(){
    if(!session()->has('user')){
       return view('user-login');
    }else{
        return redirect('/');
    }
});
Route::get('user-signup',function(){
    if(!session()->has('user')){
       return view('user-signup');
    }else{
        return redirect('/');
    }
});


Route::middleware('CheckUserAuth')->group(function () {

    Route::get('user-logout', [UserController::class, "userLogout"]);
    Route::get('mcq/{id}/{name}', [UserController::class, "mcq"]);
    Route::post('submit-next/{id}', [UserController::class, "submitAndNext"]);
    Route::get('quiz-result/{quiz_id}', [UserController::class, 'quizResult']);
    Route::get('my-results', [UserController::class, 'myResults']);
    Route::get('profile', [UserController::class, 'profile']);
});


Route::view('admin-login', 'admin-login');
Route::post('admin-login', [adminController::class, "login"]);


Route::middleware('CheckAdminAuth')->group(function () {

    Route::get('dashboard', [adminController::class, "dashboard"]);
    Route::get('admin-categories', [adminController::class, "categories"]);
    Route::post('add-category', [adminController::class, "addCategory"]);
    Route::get('category/delete/{id}', [adminController::class, "deleteCategory"]);
    Route::match(['get', 'post'], 'add-quiz', [adminController::class, 'addQuiz']);
    Route::post('add-mcq', [adminController::class, "addMCQs"]);
    Route::get('end-quiz', [adminController::class, "endQuiz"]);
    Route::get('quiz-list/{id}/{category}', [adminController::class, "quizList"]);
    Route::get('show-quiz/{id}', [adminController::class, "showQuiz"]);
    Route::get('admin-logout', [adminController::class, "logout"]);
});