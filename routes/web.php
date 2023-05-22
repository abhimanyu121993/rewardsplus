<?php

use Illuminate\Support\Facades\Route;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;
use App\Http\controllers\admin\DashboardController;
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

// Route::get('/', function () {
//     return 'First sub domain';
// // })->domain('admin.' . env('APP_URL'));
// Route::get('/admin/dashboard',[DashboardController::class,'dashboard'])->name('admin.dashboard');