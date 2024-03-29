<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminKandidatController;
use App\Http\Controllers\AdminMahasiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TotalSuaraController;
use App\Models\Student;
use Illuminate\Support\Facades\Redirect;
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

//  jika user belum login
Route::group(['middleware' => 'guest'], function() {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/', [AuthController::class, 'dologin']);

});

Route::group(['middleware' => ['auth', 'checkrole:admin,student']], function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/redirect', [RedirectController::class, 'cek']);
});


Route::group(['middleware' => ['auth', 'checkrole:admin']], function() {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::resource('/mahasiswa', AdminMahasiswaController::class);
    Route::resource('/kandidat', AdminKandidatController::class)->parameters(['kandidat' => 'slug']);
});

Route::group(['middleware' => ['auth', 'checkrole:student']], function() {
    Route::get('/student', [StudentController::class, 'index']);
    Route::get('/student/{id}', [StudentController::class, 'show']);
    Route::get('/home', [StudentController::class, 'index']);
    Route::get('/about', [StudentController::class, 'about']);
    Route::get('/cek-integrasi', [StudentController::class, 'pageIntegrasi']);
    Route::post('/cek-integrasi', [StudentController::class, 'cekIntegrasi']);
    Route::post('/home/vote/{candidate}', [StudentController::class, 'vote']);
    Route::get('/download-certificate/{token}', [PDFController::class, 'generateCertificate'])->name('download-certificate');
    // Route::get('/pengaduan', [PengaduanController::class, 'index']);
    // Route::post('/pengaduan', [PengaduanController::class, 'store']);
});

Route::get('/dashboard', function(){
    return view('dashboard.layouts.main');
});

Route::middleware(['auth', 'checkrole:student'])->group(function () {
    Route::fallback(function(){
        return view('student.index');
    });
});

Route::middleware(['auth', 'checkrole:admin'])->group(function () {
    Route::fallback(function(){
        return view('admin.index');
    });
});

Route::middleware('guest')->group(function () {
    Route::fallback(function(){
        return view('auth.login');
    });
});
