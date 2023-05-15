<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['guest'])->group(function() {
    Route::get('/', [AuthController::class, 'index']);
    Route::post('/', [AuthController::class, 'login'])->name('/');
    Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
    Route::post('/createuser', [AuthController::class, 'createUser'])->name('createUser');
    Route::get('/forgot', [AuthController::class, 'forgotPassword'])->name('forgot');
    Route::post('/sendlink-forgotpassword', [AuthController::class, 'resetLink'])->name('sendlink');
    Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');

    Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('password.update');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware('userAkses:admin');

    Route::resource('/main/landingpage', LandingPageController::class)->middleware('userAkses:customer');

    Route::resource('/admin/category', CategoryController::class)->middleware('userAkses:admin');

    Route::resource('/admin/product', ProductController::class)->middleware('userAkses:admin');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


