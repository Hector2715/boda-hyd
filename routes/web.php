<?php

use App\Http\Middleware\EnsureTeamMembership;
use App\Http\Controllers\Admin\AuthController;
use App\Livewire\Teams\AcceptInvitation;
use App\Livewire\Admin\InvitadosIndex;
use App\Livewire\RsvpForm;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Models\Invitado;

// ========================================================
// 🌿 PÁGINA PÚBLICA DE LA BODA (HÉCTOR & DANIELA)
// ========================================================
// Apunta a 'invitacion' y alias 'home' para romper el error de redirección
Route::get('/', function () {
    return view('invite', ['invitado' => null]);
})->name('invitacion')->name('home');

Route::get('/invitacion/{token}', function ($token) {
    $invitado = \App\Models\Invitado::where('token', $token)->first();
    return view('invite', ['invitado' => $invitado]);
});
// ========================================================
// 🔐 MÓDULO DE AUTENTICACIÓN ADMINISTRATIVA (BACKOFFICE)
// ========================================================
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Panel de control protegido
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});