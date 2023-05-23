<?php

use Illuminate\Support\Facades\Route;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;
use App\Http\controllers\admin\DashboardController;
use App\Http\Controllers\admin\AuthController as AdminAuth;
use App\Http\Controllers\employee\AuthController as EmployeeAuth;
use App\Http\Controllers\store\AuthController as StoreAuth;
use App\Http\Controllers\company\AuthController as CompanyAuth;
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

Route::get('/', function () {
$startDate = Carbon::now()->subYear();
$endDate = Carbon::now();

dd($analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7)));

});
Route::group(['prefix'=>'auth','as'=>'auth.','domain'=>'admin.'. env('APP_URL')],function(){
    Route::get('login',[AdminAuth::class,'login_view'])->name('login-view');
    Route::post('login',[AdminAuth::class,'login'])->name('login');
});
Route::group(['prefix'=>'auth','as'=>'auth.','domain'=>'employee.'. env('APP_URL')],function(){
    Route::get('login',[EmployeeAuth::class,'login_view'])->name('login-view');
    Route::post('login',[EmployeeAuth::class,'login'])->name('login');
});
Route::group(['prefix'=>'auth','as'=>'auth.','domain'=>'store.'. env('APP_URL')],function(){
    Route::get('login',[StoreAuth::class,'login_view'])->name('login-view');
    Route::post('login',[StoreAuth::class,'login'])->name('login');
});
Route::group(['prefix'=>'auth','as'=>'auth.','domain'=>'company.'. env('APP_URL')],function(){
    Route::get('login',[CompanyAuth::class,'login_view'])->name('login-view');
    Route::post('login',[CompanyAuth::class,'login'])->name('login');
});
// Route::get('/', function () {
//     return 'First sub domain';
// // })->domain('admin.' . env('APP_URL'));
// Route::get('/admin/dashboard',[DashboardController::class,'dashboard'])->name('admin.dashboard');