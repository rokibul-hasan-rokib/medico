<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ServiceController ;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\OtpVerificationController;
use App\Models\Department;

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
  Route::middleware(['auth'])->group(function (){
    Route::get('/appointment',[AppointmentController::class, 'index'])->name('appointment');
    Route::post('/appointment/store',[AppointmentController::class, 'store'])->name('appointment.store');
    Route::post('/appointments/{id}/update-status', [AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');
    Route::post('/appointments/{id}/delete-status', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

    Route::get('/my-appointments', [AppointmentController::class, 'userAppointments'])->name('appointments.user');
    Route::post('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');

    Route::post('/ticket/store',[TicketController::class, 'store'])->name('ticket.store');

    Route::get('/ticket',[TicketController::class, 'index'])->name('ticket');



    Route::get('/contact',[ContactController::class, 'index'])->name('contact');

    Route::post('/contact',[ContactController::class, 'store'])->name('contact.store');


    Route::get('/department',[DepartmentController::class, 'index'])->name('department');



    Route::get('/doctor',[DoctorController::class, 'index'])->name('doctor');


    Route::get('/service',[ServiceController::class, 'index'])->name('service');



    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
  });


    Route::get('/',[HomeController::class, 'index'])->name('home');
    Route::get('/about',[HomeController::class, 'about'])->name('about');
    // Route::get('/chat',[ChatController::class, 'index'])->name('chat');


    Route::get('/register',[UserController::class, 'loadRegister'])->name('register');
    Route::post('/register/store',[UserController::class, 'register'])->name('register.store');

    Route::get('verify-otp', [OtpVerificationController::class, 'showOtpForm'])->name('verify.otp.form');
    Route::post('verify-otp', [OtpVerificationController::class, 'verifyOtp'])->name('verify.otp');
    Route::get('verify-notice', [OtpVerificationController::class, 'verificationNotice'])->name('verification.notice');

    Route::get('/login',[UserController::class,'loadLogin'])->name('login.page');
    Route::post('/login',[UserController::class,'userLogin'])->name('login');






// });

// Route::group(['middleware'=>['is_logout','checkRole:admin','checkRole:super admin']],function(){



// });

  //Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
  Route::get('/logout',[UserController::class,'logout'])->name('logout');


  Route::middleware(['auth', 'role:admin,super admin,doctor'])->group(function () {

    Route::get('/admin/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    Route::get('/role/destroy/{id}', [RoleController::class, 'destroy'])->name('user.destroy');
    Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('user.edit');
    Route::post('/role/update/{id}', [RoleController::class, 'update'])->name('user.update');

    Route::get('/appointments/download-pdf', [AppointmentController::class, 'downloadPdf'])->name('appointments.downloadPdf');

    Route::get('/appointment/show',[AppointmentController::class, 'index1'])->name('appointment.show');
    Route::get('/appointment/{id}',[AppointmentController::class, 'edit'])->name('appointments.edit');
    Route::put('/appointment/update/{id}',[AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/destroy/{id}',[AppointmentController::class, 'destroy'])->name('appointments.destroy');
    Route::get('/appointments/download-pdf', [AppointmentController::class, 'downloadAppointmentsPDF'])->name('appointments.download-pdf');


    Route::get('/contact/show',[ContactController::class, 'index1'])->name('contact.show');

    Route::get('/department/show',[DepartmentController::class, 'index1'])->name('department.show');
    Route::get('/department/store',[DepartmentController::class, 'show'])->name('department.show.show');
    Route::post('/department/store',[DepartmentController::class, 'store'])->name('department.store');
    Route::delete('/department/delete/{id}',[DepartmentController::class,'destroy'])->name('department.destroy');

    Route::get('/service/show',[ServiceController::class, 'index1'])->name('service.show');
    Route::get('/service/store',[ServiceController::class, 'show'])->name('service.show.show');
    Route::post('/service/store',[ServiceController::class, 'store'])->name('service.store');

    Route::get('/doctor/show',[DoctorController::class, 'index1'])->name('doctor.show');
    Route::get('/doctor/store',[DoctorController::class, 'show'])->name('doctor.show.show');
    Route::post('/doctor/store',[DoctorController::class, 'store'])->name('doctor.store');
    Route::delete('/destroy/{id}',[DoctorController::class, 'destroy'])->name('doctor.destroy');

    Route::get('/gellary',[GalleryController::class, 'index'])->name('gallery');


    Route::get('/slider',[SliderController::class, 'index'])->name('slider');
    Route::get('/slider/store',[SliderController::class, 'show'])->name('slider.show');
    Route::post('/slider/store',[SliderController::class, 'store'])->name('slider.store');

  });