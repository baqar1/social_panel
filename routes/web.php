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


Route::get('password_update', function () {
    return view('profile/partials/update-password-form');
});
Route::get('/posts/{id}', [DashboardController::class, 'showPost'])->name('post.show');




// <-- RegisteredUserController Routes -->
Route::post('/store', [RegisteredUserController::class, 'store'])->name('store');
Route::get('/', [RegisteredUserController::class, 'welcome'])->name('welcome');
Route::get('/account_edit/{id}', [RegisteredUserController::class, 'accountEdit'])->name('account_edit');
Route::put('/account_update/{id}', [RegisteredUserController::class, 'accountUpdate'])->name('account_update');



// <-- ProfileController Routes and middleware -->
Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/admin/students', [AllStudentController::class, 'allStudents'])->name('admin.students');
Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('user_profile/{id}', [DashboardController::class, 'showProfile'])->name('user_profile');
//all routes
Route::get('/semesters/{departmentId}', [DashboardController::class, 'getSemesters']);
Route::post('project_post', [DashboardController::class, 'project_post'])->name('project_post');
Route::post('edit_post/{id}', [DashboardController::class, 'edit_post'])->name('edit_post');
Route::post('edit_post/{id}', [DashboardController::class, 'updatePost'])->name('edit_post');
Route::delete('delete_post/{id}', [DashboardController::class, 'deletePost'])->name('delete_post');
Route::get('/posts/{id}', [DashboardController::class, 'getProjectPost']);
Route::post('post', [DashboardController::class, 'post'])->name('post');
Route::post('like', [DashboardController::class, 'like'])->name('like');
Route::post('comment', [DashboardController::class, 'comment'])->name('comment');
Route::get('comments/{project_post}', [DashboardController::class, 'getComments'])->name('getComments');
Route::get('/search', [DashboardController::class, 'search'])->name('search');
Route::post('/follow/{id}', [DashboardController::class, 'follow'])->name('follow');
Route::delete('unfollow/{id}', [DashboardController::class, 'unfollow'])->name('unfollow');
Route::get('/dashboard/conversation/{userId}', [DashboardController::class, 'getConversation']);
Route::post('/dashboard/send-message/{userId}', [DashboardController::class, 'sendMessage'])->name('send_message');
Route::get('/get-message-history/{userId}', [DashboardController::class, 'getMessageHistory'])->name('get_message_history');
Route::post('/sendMessage/{id}', [DashboardController::class, 'sendMessage'])->name('send_message');
});

require __DIR__.'/auth.php';
