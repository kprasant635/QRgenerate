<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [QrController::class, 'index'])->name('index');
Route::get('/form-view', [QrController::class, 'formview'])->name('form-view');
Route::post('/login', [QrController::class, 'login']);
Route::post('/store', [QrController::class, 'store']);
Route::post('/uploadexcel', [QrController::class, 'uploadexcel']);
Route::get('/download/uploadexcel', [QrController::class, 'downloaduploadexcel']);
Route::get('/logoutsession', [QrController::class, 'logoutsession']);
Route::get('/view-qr', [QrController::class, 'view_qr']);