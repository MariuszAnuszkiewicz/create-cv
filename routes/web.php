<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;

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

Route::get('/', function () {
    return view('welcome');
});

// http://localhost:8000/create-pdf
Route::get('/create-pdf', [PDFController::class, 'createPDF'])->name('pdf.create');

// http://localhost:8000/generate-pdf
Route::match(['GET', 'POST'],'/generate-pdf', [PDFController::class, 'generatePDF'])->name('pdf.generate');
