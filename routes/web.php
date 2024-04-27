<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;

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



// Route::group(['middleware'=>['is_login']],function(){

    Route::get('/',[HomeController::class, 'index'])->name('home');
    Route::get('/about',[HomeController::class, 'about'])->name('about');
    Route::get('/chat',[ChatController::class, 'index'])->name('chat');
    Route::get('/register',[UserController::class, 'loadRegister'])->name('register');
    Route::post('/register/store',[UserController::class, 'register'])->name('register.store');
    Route::get('/login',[UserController::class,'loadLogin'])->name('login.page');
    Route::post('/login',[UserController::class,'userLogin'])->name('login');


    Route::get('/appointment',[AppointmentController::class, 'index'])->name('appointment');
    Route::post('/appointment',[AppointmentController::class, 'store'])->name('appointment.store');
    Route::get('/contact',[ContactController::class, 'index'])->name('contact');
    Route::post('/contact',[ContactController::class, 'store'])->name('contact.store');
    Route::get('/department',[DepartmentController::class, 'index'])->name('department');
    Route::get('/doctor',[DoctorController::class, 'index'])->name('doctor');
    Route::get('/service',[ServiceController::class, 'index'])->name('service');


    
// });

// Route::group(['middleware'=>['is_logout','checkRole:admin','checkRole:super admin']],function(){
  


// });

  //Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
  Route::get('/logout',[UserController::class,'logout'])->name('logout');  
  Route::get('/admin/dashboard',[DashboardController::class,'index'])->name('dashboard');
  Route::get('/role', [RoleController::class, 'index'])->name('role.index');
  Route::get('/role/destroy/{id}', [RoleController::class, 'destroy'])->name('user.destroy');
  Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('user.edit');
  Route::post('/role/update/{id}', [RoleController::class, 'update'])->name('user.update');