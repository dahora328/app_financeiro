<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LancamentoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/lancamento', function (){
    return view('app.lancamento');
})->name('lancamento')->middleware('auth');
Route::get('/categoria', [CategoriaController::class, 'index'])->name('categoria')->middleware('auth');
