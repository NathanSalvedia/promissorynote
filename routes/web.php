

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\PromissoryNoteController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\SubledgerController;
use App\Http\Controllers\StatusTrackingController;
use App\Http\Controllers\PaymentHistoryController;
use App\Http\Controllers\ManageRecordsController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\PaymentTrackingController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/login', function () {
    return view('auth.login');
})->name('auth.login');


   Route::middleware(['auth'])->group(function () {
    Route::get('/student/dashboard', DashboardController::class)->name('student.dashboard');
    Route::get('/student/promissorynote', [PromissoryNoteController::class, 'index'])->name('student.promissorynote');
    Route::post('/student/promissorynote', [PromissoryNoteController::class, 'store'])->name('promissorynotes.store');
    Route::get('/promissorynotes', [PromissoryNoteController::class, 'index'])->name('promissorynotes.index');
    Route::get('/student/promissorynote/check-status', [PromissoryNoteController::class, 'checkStatus'])->name('promissorynote.checkStatus');
    //Route::get('/student/promissorynote/images', [ImageController::class, 'create'])->name('promissorynotes.images.create');
    //Route::post('/student/promissorynote/images', [ImageController::class, 'store'])->name('promissorynotes.images.store');
    Route::get('/student/subledger', [SubledgerController::class, 'index'])->name('student.subledger');
    Route::get('/student/status-tracking', [StatusTrackingController::class, 'index'])->name('student.status-tracking');
    Route::get('/student/payment-history', [PaymentHistoryController::class, 'index'])->name('student.payment-history');
    Route::get('/student/promissorynote/view/{id}', [PromissoryNoteController::class, 'view'])->name('student.promissorynote.view');

 });


   Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin.login');
   Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');



    Route::middleware(['web'])->group(function () {
    Route::get('/admin/admindashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/manage-record', [ManageRecordsController::class, 'index'])->name('admin.manage-record');
    Route::get('/admin/promissorynote-detail/{pn_id}', [AdminDashboardController::class, 'show'])->name('admin.promissorynote-detail');
    Route::post('/admin/promissory/approve/{pn_id}', [AdminDashboardController::class, 'approve'])->name('admin.promissory.approve');
    Route::post('/admin/promissory/reject/{pn_id}', [AdminDashboardController::class, 'reject'])->name('admin.promissory.reject');
    Route::get('/admin/manage-records', [ManageRecordsController::class, 'manageRecords'])->name('admin.manage-records');
    Route::get('/admin/manage-users', [ManageUserController::class, 'index'])->name('admin.manage-users');
    Route::get('/admin/payment-tracking', [PaymentTrackingController::class, 'index'])->name('admin.payment-tracking');
});







//Route::get('/admin/admindashboard', function () {
    //return view('admin.admindashboard');
//})->middleware(['web'])->name('admin.admindashboard');


