<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PeminjamanController;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return view('welcome');
    }
});


// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
    Route::get('/sarprastb', function () {
        return view('welcome');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile/delete/{id}', [AuthController::class, 'deleteProfile'])->name('profile.delete');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('barangs', BarangController::class);
    Route::resource('kategoris', KategoriController::class);
    Route::resource('users', UsersController::class);
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // Peminjaman Sarana
    Route::get('/peminjaman-sarana', [PeminjamanController::class, 'index'])->name('peminjaman-sarana.index');
    Route::post('/peminjaman-sarana/{id}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman-sarana.approve');
    Route::post('/peminjaman-sarana/{id}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman-sarana.reject');
    Route::post('/peminjaman-sarana/{id}/confirm', [PeminjamanController::class, 'confirm'])->name('peminjaman-sarana.confirm');
    Route::put('/peminjaman-sarana/{id}/return', [PeminjamanController::class, 'return'])->name('peminjaman-sarana.return');
    Route::get('/peminjaman-sarana/report', [PeminjamanController::class, 'report'])->name('peminjaman-sarana.report');
});

Route::get('users-export/', [UsersController::class, 'export'])->name('export');