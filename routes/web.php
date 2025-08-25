

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
    //Route::get('/student/promissorynote/images', [ImageController::class, 'create'])->name('promissorynotes.images.create');
    //Route::post('/student/promissorynote/images', [ImageController::class, 'store'])->name('promissorynotes.images.store');
    Route::get('/student/subledger', [SubledgerController::class, 'index'])->name('student.subledger');
    Route::get('/student/status-tracking', [StatusTrackingController::class, 'index'])->name('student.status-tracking');
    Route::get('/student/payment-history', [PaymentHistoryController::class, 'index'])->name('student.payment-history');
    Route::get('/student/promissorynote/view/{id}', [PromissoryNoteController::class, 'view'])->name('student.promissorynote.view');
});


Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');


Route::get('/admin/admindashboard', [AdminDashboardController::class, 'index'])->middleware(['web'])->name('admin.dashboard');
Route::get('/admin/manage-record', [ManageRecordsController::class, 'index'])->middleware(['web'])->name('admin.manage-record');
Route::get('/admin/manage-record/{pn_id}', [ManageRecordsController::class, 'show'])->middleware(['web'])->name('admin.manage-record.show');





//Route::get('/admin/admindashboard', function () {
    //return view('admin.admindashboard');
//})->middleware(['web'])->name('admin.admindashboard');


