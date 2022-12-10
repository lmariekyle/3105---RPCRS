<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerClassController;
use App\Http\Controllers\CustEnClassController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GymClassController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth','role:SuperAdmin'])->name('admin.')->prefix('Admin')->group(function(){
    Route::get('/',[IndexController::class, 'index'])->name('index');
    Route::resource('/roles', 'Admin\RoleController');
    Route::post('/roles/{role}/permissions',[RoleController::class, 'givePermission'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}',[RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
    Route::resource('/permissions', 'Admin\PermissionController');
});

Route::resource('members', 'CustomerController');
Route::resource('members.class', 'CustomerClassController')->shallow();
Route::resource('members.enclass', 'CustEnClassController')->shallow();
Route::resource('gymclass', 'GymClassController');
Route::resource('staffdetails', 'StaffDetailsController');
Route::resource('gymclass.customers', 'ClassCustomerController')->shallow();
Route::resource('gymclass.enmem', 'ClassEnCustomerController')->shallow();
Route::resource('membership', 'MembershipController');
Route::resource('membership.customers', 'CustomerMembershipController')->shallow();
Route::resource('membership.encust', 'CustEnMembershipController')->shallow();

Route::resource('employees','EmployeeController');
Route::get('/employees/role/{employee}', [EmployeeController::class, 'viewEmployee'])->name('employees.viewEmployee');
Route::post('/employees/role/{employee}/roles', [EmployeeController::class, 'assignRole'])->name('employees.roles');
Route::delete('/employees/role/{employee}/roles/{role}', [EmployeeController::class, 'removeRole'])->name('employees.roles.remove');

Route::get('/gymclass/instructor/{gymclass}', [GymClassController::class, 'viewInstructor'])->name('gymclass.viewInstructor');
Route::post('/employees/instructor/{gymclass}/add', [GymClassController::class, 'assignInstructor'])->name('gymclass.assignInstructor');
Route::delete('/employees/instructor/{gymclass}/remove/{instructor}', [GymClassController::class, 'removeInstructor'])->name('gymclass.removeInstructor');
require __DIR__.'/auth.php';
