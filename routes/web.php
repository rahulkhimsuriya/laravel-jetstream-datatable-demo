<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrganizationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth:sanctum', 'verified'])
    ->name('dashboard');

Route::prefix('/organizations')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', [OrganizationController::class, 'index'])->name('organizations.index');
    Route::get('/create', [OrganizationController::class, 'create'])->name('organizations.create');
    Route::post('/', [OrganizationController::class, 'store'])->name('organizations.store');
    Route::get('/{organization}/edit', [OrganizationController::class, 'edit'])->name('organizations.edit');
    Route::put('/{organization}', [OrganizationController::class, 'update'])->name('organizations.update');
});
