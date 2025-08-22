<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;



Route::get('/', function () {
    return view('welcome');
});



Route::get('/student/dashboard', DashboardController::class)->middleware(['auth']);

Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

