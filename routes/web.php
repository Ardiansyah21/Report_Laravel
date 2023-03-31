<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResponseController;


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
Route::get('/', [ReportController::class, 'index'])->name('index');

Route::middleware('islogin','CekRole:petugas')->group(function(){
Route::get('/data/petugas', [ReportController::class, 'datapetugas'])->name('data.petugas');
Route::get('response/edit/{report_Id}', [ResponseController::class,'edit'])->name('response.edit');
Route::patch('response/edit/{report_Id}', [ResponseController::class,'update'])->name('response.update');
});

Route::middleware('islogin','CekRole:petugas')->group(function(){
});
Route::middleware('islogin','CekRole:admin')->group(function(){
Route::get('/data', [ReportController::class, 'data'])->name('data');
Route::delete('/hapus/{id}', [ReportController::class, 'destroy'])->name('delete');
Route::get('/exportpdf', [ReportController::class, 'exportpdf'])->name('exportpdf');
Route::get('/createpdf{id}', [ReportController::class, 'createpdf'])->name('create.pdf');
});
Route::get('/login', [ReportController::class, 'login'])->name('login');
Route::post('/login', [ReportController::class, 'auth'])->name('login.auth');
Route::post('/home', [ReportController::class, 'store'])->name('dashboard');
Route::get('/logout', [ReportController::class, 'logout'])->name('logout');






