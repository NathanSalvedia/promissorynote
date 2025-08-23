

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\PromissoryNoteController;


Route::get('/', function () {
    return view('welcome');
});



Route::get('/student/dashboard', DashboardController::class)->middleware(['auth'])->name('student.dashboard');

Route::get('/student/promissorynote', [PromissoryNoteController::class, 'index'])->name('student.promissorynote');
Route::post('/student/promissorynote', [PromissoryNoteController::class, 'store'])->name('promissorynotes.store');
Route::get('/promissorynotes', [PromissoryNoteController::class, 'index'])->name('promissorynotes.index');


















Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin.login');

//Route::get('/admin/admindashboard', function () {
    //return view('admin.admindashboard');
//})->middleware(['web'])->name('admin.admindashboard');

Route::get('/admin/admindashboard', [AdminDashboardController::class, 'index'])->middleware(['auth', 'admin']);



