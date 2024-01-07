<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClassListController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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

Route::get('/', [Controller::class, 'index'])
    ->name('login')
    ->middleware('guest');
Route::post('/login/process', [AuthController::class, 'loginProcess']);
Route::get('/login/google', [AuthController::class, 'redirectToGoogle']);
Route::get('login/google/callback', [AuthController::class, "handleCallback"]);

Route::get('/admin/home', [dashboardController::class, 'index'])
    ->name('home')
    ->middleware('admin');
    
Route::get('/users/home', [homeController::class, 'index'])
->name('classroom')
->middleware('teacher');

Route::post('/adduser', [TeacherController::class, 'adduser']);
Route::post('/addstudent', [StudentController::class, 'addstudent']);
Route::post('/setTeacher', [ClassListController::class, 'setteacher']);
Route::post('/getPie', [ClassListController::class, 'getpie']);
    
Route::get('/logout', [AuthController::class, 'logout']);
    
Route::get('/file-import',[ClassListController::class,
'importView'])->name('import-view'); 
Route::post('/import',[ClassListController::class,
'import'])->name('import'); 
Route::get('/export-classlist',[ClassListController::class,
'export'])->name('export-classlist');
    