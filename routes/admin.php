<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RolePermissionController;
use App\Http\Controllers\admin\CompanyController;
use App\Http\Controllers\admin\StoreController;
// Auth Route

// logout route
Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::group(['prefix' => 'role-permission', 'as' => 'role-permission.'], function () {
    Route::resource('role', RoleController::class)->name('role', '');
    Route::resource('permission', PermissionController::class)->name('permission', '');
    Route::get('role-has-permission', [RolePermissionController::class, 'role_permission']);
    Route::post('fetch-permissions', [RolePermissionController::class, 'fetch_permission']);
    Route::post('assign-permission', [RolePermissionController::class, 'assign_permission']);
    Route::get('fetch-role', [RoleController::class, 'fetch_role'])->name('fetch-role');
    Route::get('/isactive/{id}', [RoleController::class, 'is_active'])->name('active-role');
    Route::get('customer-has-permission', [RoleController::class, 'fetch_role']);
});

Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
Route::post('company/subcategory',[CompanyController::class,'get_company_subcategory'])->name('company.subcategory');
Route::get('company/old-companies',[CompanyController::class,'fetch_old_companies'])->name('company.fetch-old-companies');
Route::get('company/employee',[CompanyController::class,'company_employee'])->name('company.employee');
Route::get('company/old-employees',[CompanyController::class,'fetch_old_employees'])->name('company.fetch-old-employees');
Route::resource('company',CompanyController::class)->name('company','');
Route::get('store/old-stores',[StoreController::class,'fetch_old_stores'])->name('store.fetch-old-stores');
Route::resource('store',StoreController::class)->name('store','');
