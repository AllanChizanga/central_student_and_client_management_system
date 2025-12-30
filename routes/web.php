<?php

use App\Http\Middleware\IsAuth;
use App\Livewire\ClientLivewire;
use App\Livewire\CourseLivewire;
use App\Livewire\IntakeLivewire;
use App\Livewire\StudentLivewire;
use App\Livewire\DashboardLivewire;
use App\Livewire\EnrollmentLivewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Livewire\ProjectVersionLivewire;



#AUTHENTICATION ROUTES 
// Route::view('/','login')->name('home');
Route::controller(AuthController::class)->prefix('secure-auth')->group(function(){
Route::post('login','login')->name('login'); 
Route::view('login','login')->name('get-login'); #only used by auth middleware when redirecting user that fails to authenticate
Route::post('logout','logout')->name('logout');
});


#DASHBOARD 
Route::get('/',DashboardLivewire::class)->name('dashboard')->middleware('auth');  


#STUDENT CRUDS
Route::get('student-management',StudentLivewire::class)->name('student')->middleware('auth');


#COURSE
Route::get('course-management',CourseLivewire::class)->name('course')->middleware('auth');  

#INTAKE
Route::get('intake-management',IntakeLivewire::class)->name('intake')->middleware('auth');  

#ENROLLMENT
Route::get('enrollment-management',EnrollmentLivewire::class)->name('enrollment')->middleware('auth');  

#CLIENT
Route::get('client-management',ClientLivewire::class)->name('client')->middleware('auth');  

#PROJECT VERSION
Route::get('project-version-management',ProjectVersionLivewire::class)->name('project-version')->middleware('auth');  