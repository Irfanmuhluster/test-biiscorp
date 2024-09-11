<?php

use App\Http\Controllers\EmployeeFrontendController;
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

Route::get('/employees', [EmployeeFrontendController::class, 'index'])->name('employee.index');

Route::get('/employees/create', [EmployeeFrontendController::class, 'create'])->name('employee.create');


Route::get('/', function () {
    return view('welcome');
});
