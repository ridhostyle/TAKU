<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\PermohonanController;


Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return 'Home Page';
})->middleware('auth')->name('dashboard');

Route::get('/dashboard', function () {
     return view('login.dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/permohonan', function () {
    return view('permohonan');
});
Route::get('/formpermohonan', [PermohonanController::class, 'showForm'])->name('form.permohonan');
Route::post('/formpermohonan', [PermohonanController::class, 'store'])->name('form.permohonan.store');

Route::post('/permohonan/{id}/terima', [PermohonanController::class, 'terima'])
    ->name('permohonan.terima');
Route::post('/permohonan/{id}/tolak', [PermohonanController::class, 'tolak'])
    ->name('permohonan.tolak');

Route::get('/verifikasi', [PermohonanController::class, 'index'])->name('form.verifikasi');

Route::get('/datapegawai', function () {
    return view('login.datapegawai');
});
Route::get('/cuti/create', [CutiController::class, 'create'])->name('cuti.create');
Route::post('/cuti', [CutiController::class, 'store'])->name('cuti.store');
Route::get('/cuti', [CutiController::class, 'index'])->name('cuti.index');
Route::put('/cuti/{id}', [CutiController::class, 'update'])->name('cuti.update');

Route::get('/formulir', function () {
    return view('login.form.printout');
});
Route::get('/formulir', function () {
    return view('login.form.printout');
});

Route::get('/status', [PermohonanController::class, 'showStatus']) -> name('status');
Route::post('/check-status', [PermohonanController::class, 'checkStatus'])->name('check.status');

Route::get('/formpermohonan', [PermohonanController::class, 'showForm'])->name('form.permohonan');
Route::post('/formpermohonan', [PermohonanController::class, 'store'])->name('form.permohonan.store');

