<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AllStudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('index', function () {
    return view('admin.index');
});
Route::get('projects', function () {
    return view('admin.projects');
});
Route::get('profiles', function () {
    return view('admin.profiles');
});
Route::get('jobs', function () {
    return view('admin.jobs');
});
Route::get('index', function () {
    return view('admin.index');
});
Route::get('user-profile',function(){
    return view('admin.user-profile');
});
Route::get('my-profile',function(){
    return view('admin.my-profile-feed');
});
Route::get('sign-in',function(){
    return view('admin.sign-in');
});



// <-- RegisteredUserController Routes -->
Route::post('/store', [RegisteredUserController::class, 'store'])->name('store');
Route::get('/', [RegisteredUserController::class, 'welcome'])->name('welcome');

// <-- DashboardController Routes -->
Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/semesters/{departmentId}', [DashboardController::class, 'getSemesters']);
Route::post('project_post', [DashboardController::class, 'project_post'])->name('project_post');
Route::post('post', [DashboardController::class, 'post'])->name('post');
Route::post('like', [DashboardController::class, 'like'])->name('like');
Route::post('comment', [DashboardController::class, 'comment'])->name('comment');
Route::get('user_profile/{id}', [DashboardController::class, 'showProfile'])->name('user_profile');
Route::get('/search', [DashboardController::class, 'search'])->name('search');
Route::post('/follow/{id}', [DashboardController::class, 'follow'])->name('follow');
Route::delete('unfollow/{id}', [DashboardController::class, 'unfollow'])->name('unfollow');
Route::post('/sendMessage/{id}', [DashboardController::class, 'sendMessage'])->name('send_message');

// <-- AllStudentController Routes -->
Route::get('/admin.students', [AllStudentController::class, 'allStudents'])->name('admin.students');


// <-- ProfileController Routes and middleware -->
Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
