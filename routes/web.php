<?php

use App\Http\Middleware\IsAuth;
use App\Livewire\StudentLivewire;
use App\Livewire\DashboardLivewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



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