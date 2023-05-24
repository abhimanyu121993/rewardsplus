<?php

use App\Http\Controllers\company\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\company\AttendanceController;
use App\Http\Controllers\company\AuthController;
use App\Http\Controllers\company\LeaveController;

Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
Route::get('logout',[AuthController::class, 'logout'])->name('auth.logout');
Route::name('attendance.')->group(function(){
    Route::get('attendance/index',[AttendanceController::class,'index'])->name('index');
    Route::post('attendance/clock-in',[AttendanceController::class,'clock_in'])->name('clock-in');
});
Route::name('employee.')->group(function(){
    Route::get('leave-application',[LeaveController::class,'leave_application'])->name('leave.application');
    Route::post('leave-status',[LeaveController::class,'leave_status'])->name('leave.status');
});

