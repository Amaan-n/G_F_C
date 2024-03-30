<?php

use App\Http\Controllers\GrandFatherController;
use App\Http\Controllers\FatherController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\activityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('layout.base');
})->name('dashboard');

//GrandFather Routes
Route::prefix('grandfather')->name('grand.')->group(function () {
    Route::get('/', [GrandFatherController::class, 'index'])->name('show');
    Route::post('/add', [GrandFatherController::class, 'add'])->name('add');
    Route::put('/edit', [GrandFatherController::class, 'edit'])->name('edit');
    Route::delete('/delete', [GrandFatherController::class, 'delete'])->name('delete');
});

//Father Routes
Route::prefix('father')->name('father.')->group(function () {
    Route::get('/', [FatherController::class, 'index'])->name('show');
    Route::post('/add', [FatherController::class, 'add'])->name('add');
    Route::put('/edit', [FatherController::class, 'edit'])->name('edit');
    Route::delete('/delete', [FatherController::class, 'delete'])->name('delete');
});

//Child Routes
Route::prefix('child')->name('child.')->group(function () {
    Route::get('/', [ChildController::class, 'index'])->name('show');
    Route::post('/add', [ChildController::class, 'add'])->name('add');
    Route::put('/edit', [ChildController::class, 'edit'])->name('edit');
    Route::delete('/delete', [ChildController::class, 'delete'])->name('delete');
});

//logs
Route::get('/logs', [activityController::class, 'showActivityLogs'])->name('logs.show');