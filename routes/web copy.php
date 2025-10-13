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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// PROFILE (Shared)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (Secretariat)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('agendas', AgendaController::class)->except(['show']);
    Route::post('/agendas/{agenda}/concerns', [ConcernController::class, 'store'])->name('concerns.store');
    Route::put('/concerns/{concern}', [ConcernController::class, 'update'])->name('concerns.update');
    Route::delete('/concerns/{concern}', [ConcernController::class, 'destroy'])->name('concerns.destroy');
});

/*
|--------------------------------------------------------------------------
| MEMBER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:member'])
    ->prefix('member')
    ->name('member.')
    ->group(function () {
        Route::get('/agendas', [AgendaController::class, 'index'])->name('agendas.index');
        Route::get('/agendas/{agenda}', [AgendaController::class, 'show'])->name('agendas.show');
        Route::post('/agendas/{agenda}/concerns', [ConcernController::class, 'store'])->name('concerns.store');
    });


/*
|--------------------------------------------------------------------------
| VIEWER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/agendas', [AgendaController::class, 'index'])->name('user.agendas.index');
    Route::get('/agendas/{agenda}', [AgendaController::class, 'show'])->name('user.agendas.show');
});

require __DIR__.'/auth.php';