<?php

use App\Http\Controllers\company\AttendanceController;
use App\Http\Controllers\company\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\company\DashboardController;


Route::get('logout',[AuthController::class, 'logout'])->name('auth.logout');
Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
Route::name('attendance.')->group(function(){
    Route::get('attendance/index',[AttendanceController::class,'index'])->name('index');
    Route::post('attendance/clock-in',[AttendanceController::class,'clock_in'])->name('clock-in');
});