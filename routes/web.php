<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BatchController;

use App\Http\Controllers\FeesController;

use App\Http\Controllers\LocationController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\Student\RegistrationController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\User\AuthController As UserAuth;
use App\Http\Controllers\User\AttendanceController as UserAttendance;
use App\Http\Controllers\User\FeesController as UserFees;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CashfreeController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\CouponCodeController;
use App\Http\Controllers\User\UserProfileController;


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

Route::get('/', [DashboardController::class,'dashboard'])->name('home');

Route::get('/admin/login', function () {
    return view('Admin.login');
})->name('admin.login');


Route::post('/admin/login', [AuthController::class,'login'])->name('admin.login.validate');
Route::get('/logout', [AuthController::class,'logout'])->name('admin.logout');


Route::get('/user/fees-payments', [UserFees::class,'index'])->name('user.fees');
Route::get('/user/attendance', [UserAttendance::class,'index'])->name('user.attendance');


Route::get('/user/logout', [UserAuth::class,'logout'])->name('user.logout');

Route::get('login', function () {
    return view('User.login');
})->name('login');
Route::post('login', [UserAuth::class,'login'])->name('login.validate');

// Route::get('student/register', [RegistrationController::class,'create']);
// Route::post('student/register', [RegistrationController::class,'register'])->name('student-register');
Route::resource('student/register', RegistrationController::class);

Route::get('attendance/register/view',[AttendanceController::class,'registerView'])->name('registerview');

Route::resource('attendance', AttendanceController::class);
Route::resource('batch', BatchController::class);
Route::get('fees/markpaid/{id}',[FeesController::class,'updateFeesStatus'])->name('updatefees');

Route::resource('fees', FeesController::class);
Route::get('location/delete/{id}',[LocationController::class,'destroy']);
Route::resource('coupon-code', CouponCodeController::class);

Route::resource('location', LocationController::class);
Route::resource('students', StudentsController::class);
Route::get('students/edit/{id}',[StudentsController::class,'edit'])->name('studentedit');
Route::get('students/delete/{id}',[StudentsController::class,'destroy'])->name('students.delete');
Route::get('students/batch-delete/{id}',[StudentsController::class,'deleteBatch'])->name('student.batch.delete');
Route::get('students/addbatch/{id}',[StudentsController::class,'addBatch'])->name('students.addbatch');
Route::post('students/addbatch',[StudentsController::class,'addNewBatch'])->name('students.addnewbatch');

Route::get('monthlyfees', [FeesController::class,'generateMonthlyFees']);
Route::get('location/getbatches/{id}', [LocationController::class,'getBatches'])->name('getbatches');
Route::get('batch/stuents/{id}', [BatchController::class,'getstudentslist']);
Route::get('custom-message', [SmsController::class,'customMessage'])->name('custom-message');
Route::get('sms-template-details/{id}', [SmsController::class,'smsTemplate']);
Route::post('/send-sms', [SmsController::class,'publishMessage'])->name('publish-message');

Route::get('/cashfree-payment-gateway', [CashfreeController::class,'cashfree_payment_gateway']);
Route::post('/order', [CashfreeController::class,'order']);
Route::post('/return-url', [CashfreeController::class,'return_url']);

Route::get('user-profile', [UserProfileController::class,'show'])->name('userprofile');
Route::get('userprofile/edit', [UserProfileController::class,'edit'])->name('edit.userprofile');
Route::get('user/addbatch',[UserProfileController::class,'addBatch'])->name('student.addbatch');
Route::post('user/addbatch',[UserProfileController::class,'addNewBatch'])->name('student.addnewbatch');
