<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/employees', [EmployeeController::class, 'index'])->name('api.employees');
Route::get('/positions', [PositionController::class, 'index'])->name('api.positions');
Route::post('/employees/store', [EmployeeController::class, 'store'])->name('api.employees.store');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
