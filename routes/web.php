<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// -------------------- ADMIN / SECRETARIAT ROUTES --------------------

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
     Route::get('/agendas', [AgendaController::class, 'index'])->name('agendas.index');
    Route::get('/agendas/create', [AgendaController::class, 'create'])->name('agendas.create');
    Route::post('/agendas', [AgendaController::class, 'store'])->name('agendas.store');
    Route::get('/agendas/{agenda}/edit', [AgendaController::class, 'edit'])->name('agendas.edit');
    Route::put('/agendas/{agenda}', [AgendaController::class, 'update'])->name('agendas.update');
    Route::delete('/agendas/{agenda}', [AgendaController::class, 'destroy'])->name('agendas.destroy');

    // Manage Concerns under each Agenda
    Route::post('/agendas/{agenda}/concerns', [ConcernController::class, 'store'])->name('concerns.store');
    Route::put('/concerns/{concern}', [ConcernController::class, 'update'])->name('concerns.update');
    Route::delete('/concerns/{concern}', [ConcernController::class, 'destroy'])->name('concerns.destroy');
});

Route::middleware(['auth', 'role:member'])->group(function(){
    // View all agendas and specific details
    Route::get('/agendas', [AgendaController::class, 'index'])->name('agendas.index');
    Route::get('/agendas/{agenda}', [AgendaController::class, 'show'])->name('agendas.show');

    // Members can comment or raise concerns
    Route::post('/agendas/{agenda}/concerns', [ConcernController::class, 'store'])->name('concerns.store');
});
Route::middleware(['auth', 'role:user'])->group(function () {

    // Read-only access
    Route::get('/agendas', [AgendaController::class, 'index'])->name('agendas.index');
    Route::get('/agendas/{agenda}', [AgendaController::class, 'show'])->name('agendas.show');
});
require __DIR__.'/auth.php';