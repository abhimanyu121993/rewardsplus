<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AuthController as AdminAuth;
use App\Http\Controllers\employee\AuthController as EmployeeAuth;
use App\Http\Controllers\store\AuthController as StoreAuth;
use App\Http\Controllers\company\AuthController as CompanyAuth;
use Carbon\Carbon;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

// Route::get('/', function () {
//     $startDate = Carbon::now()->subYear();
//     $endDate = Carbon::now();
    
//     dd($analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7)));
    
//     });

    Route::group(['as'=>'admin.','domain'=>'admin.'.env('APP_URL')],function(){
        Route::get('/',function(){
            return redirect()->route('admin.auth.login-view');
        });
    });
    Route::group(['as'=>'company.','domain'=>'company.'.env('APP_URL')],function(){
        Route::get('/',function(){
            return redirect()->route('company.auth.login-view');
        });
    });
    Route::group(['as'=>'employee.','domain'=>'employee.'.env('APP_URL')],function(){
        Route::get('/',function(){
            return redirect()->route('employee.auth.login-view');
        });
    });
    Route::group(['prefix'=>'auth','as'=>'admin.auth.','domain'=>'admin.'. env('APP_URL')],function(){
       
        Route::get('login',[AdminAuth::class,'login_view'])->name('login-view');
        Route::post('login',[AdminAuth::class,'login'])->name('login');
    });
    Route::group(['prefix'=>'auth','as'=>'employee.auth.','domain'=>'employee.'. env('APP_URL')],function(){
        Route::get('/',function(){return redirect()->route('employee.auth.login');});
        Route::get('login',[EmployeeAuth::class,'login_view'])->name('login-view');
        Route::post('login',[EmployeeAuth::class,'login'])->name('login');
    });
    Route::group(['prefix'=>'auth','as'=>'store.auth.','domain'=>'store.'. env('APP_URL')],function(){
        Route::get('/',function(){return redirect()->route('store.auth.login');});
        Route::get('login',[StoreAuth::class,'login_view'])->name('login-view');
        Route::post('login',[StoreAuth::class,'login'])->name('login');
    });
    Route::group(['prefix'=>'auth','as'=>'company.auth.','domain'=>'company.'. env('APP_URL')],function(){
        Route::get('/',function(){return redirect()->route('company.auth.login');});
        Route::get('login',[CompanyAuth::class,'login_view'])->name('login-view');
        Route::post('login',[CompanyAuth::class,'login'])->name('login');
    });
