<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserLogController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PhoneController;

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

// Route::get('/', function () {
//     return view('auth.login');
// });



Route::middleware(['auth','verified'])->group(function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/phones', [PhoneController::class, 'index'])->name('phones.index');
    Route::get('/phones/create', [PhoneController::class, 'create'])->name('phones.create');
    Route::get('/phones/edit/{phone}', [PhoneController::class, 'edit'])->name('phones.edit');
    Route::post('/phones', [PhoneController::class, 'store'])->name('phones.store');
    Route::put('/phones/{phone}', [PhoneController::class, 'update'])->name('phones.update');
    Route::delete('/phones/delete/{phone}', [PhoneController::class, 'destroy'])->name('phones.destroy');

    Route::get('/logs', [UserLogController::class, 'index']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);

    Route::get('/register', [AuthController::class, 'create'])->name('register');
    Route::post('/register', [AuthController::class, 'store']);

    Route::get('/verification/{user}/{token}', [AuthController::class, 'verification']);
});

Route::get('/sendmail', [EmailController::class, 'sendEmail']);
