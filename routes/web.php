<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ConcernController;
/*
|--------------------------------------------------------------------------
| Agenda Module Routes
|--------------------------------------------------------------------------
| Roles:
| - Admin (Secretariat): full CRUD access
| - Member (Agent/User): can view agendas and comment/raise concerns
| - Viewer: can only view agendas
|--------------------------------------------------------------------------
*/


Route::get('/', function () {
    return view('welcome');
});

// Shared dashboard
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// One shared agendas resource for all roles
Route::middleware(['auth'])->group(function () {
    Route::resource('agendas', AgendaController::class);
    Route::post('/agendas/{agenda}/concerns', [ConcernController::class, 'store'])->name('concerns.store');
});

// Admin dashboard
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

require __DIR__.'/auth.php';