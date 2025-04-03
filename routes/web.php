<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Auth\RegisteredUserController;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

Route::middleware(['auth', 'role:superadmin'])->prefix('admin')->group(function () {
    Route::get('/agents', [AgentController::class, 'index'])->name('admin.agents');
    Route::get('add-agent', [AgentController::class, 'create'])->name('admin.addagent');
    Route::post('add-agent', [AgentController::class, 'store'])->name('admin.storeagent');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    /*Route::post('/signature/store', [SignatureController::class, 'store'])->name('signature.store');
    Route::get('/signature/{id}', [SignatureController::class, 'show'])->name('signature.show');
    Route::get('/signature/download/{id}', [SignatureController::class, 'downloadPdf'])->name('signature.download');*/
});

require __DIR__.'/auth.php';



