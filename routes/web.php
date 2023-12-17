<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AssignSubjectController;
use App\Http\Controllers\StudentController;

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

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'Authlogin'])->name('auth.login');
Route::get('logout', [AuthController::class, 'logout']);
Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot.password');
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword'])->name('forgot.password');

Route::get('/admin/admin/list', function () {
    return view('admin.admin.list');
});

// Middleware Route Group
Route::middleware(['admin'])->group(function () {
    Route::get('admin/dashboard',[DashboardController::class, 'dashboard']);
    Route::get('admin/admin/list',[AdminController::class, 'list']);
    Route::get('admin/admin/add',[AdminController::class, 'add']);
    Route::post('admin/admin/add',[AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}',[AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}',[AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}',[AdminController::class, 'delete']);

    //class routes
    Route::get('admin/class/list',[ClassController::class, 'list']);
    Route::get('admin/class/add',[ClassController::class, 'add']);
    Route::post('admin/class/add',[ClassController::class, 'insert']);
    Route::get('admin/class/edit/{id}',[ClassController::class, 'edit']);
    Route::post('admin/class/edit/{id}',[ClassController::class, 'update']);
    Route::get('admin/class/delete/{id}',[ClassController::class, 'delete']);

    //subject routes
    Route::get('admin/subject/list',[SubjectController::class, 'list']);
    Route::get('admin/subject/add',[SubjectController::class, 'add']);
    Route::post('admin/subject/add',[SubjectController::class, 'insert']);
    Route::get('admin/subject/edit/{id}',[SubjectController::class, 'edit']);
    Route::post('admin/subject/edit/{id}',[SubjectController::class, 'update']);
    Route::get('admin/subject/delete/{id}',[SubjectController::class, 'delete']);

    //assin subject
    Route::get('admin/assign_subject/list',[AssignSubjectController::class, 'list']);
    Route::get('admin/assign_subject/add',[AssignSubjectController::class, 'add']);
    Route::post('admin/assign_subject/add',[AssignSubjectController::class, 'insert']);
    Route::get('admin/assign_subject/edit/{id}',[AssignSubjectController::class, 'edit']);
    Route::post('admin/assign_subject/edit/{id}',[AssignSubjectController::class, 'update']);
    Route::get('admin/assign_subject/delete/{id}',[AssignSubjectController::class, 'delete']);
    Route::get('admin/assign_subject/edit_single/{id}', [AssignSubjectController::class,'edit_single']);
    Route::post('admin/assign_subject/edit_single/{id}',[AssignSubjectController::class, 'update_single']);

    //student
    Route::get('admin/student/list',[StudentController::class, 'list']);
    Route::get('admin/student/add', [StudentController::class, 'add']);
    Route::post('admin/student/add', [StudentController::class, 'insert']);
    Route::get('admin/student/edit/{id}', [StudentController::class, 'edit']);
    Route::post('admin/student/edit/{id}', [StudentController::class, 'update']);
    Route::get('admin/student/delete/{id}', [StudentController::class, 'delete']);
    

});
Route::middleware(['parent'])->group(function () {
    Route::get('parent/dashboard',[DashboardController::class, 'dashboard']);
});
Route::middleware(['student'])->group(function () {
    Route::get('student/dashboard',[DashboardController::class, 'dashboard']);
});
Route::middleware(['teacher'])->group(function () {
    Route::get('teacher/dashboard',[DashboardController::class, 'dashboard']);
});