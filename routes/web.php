<?php

use App\Http\Middleware\EnsureTeamMembership;
use Illuminate\Support\Facades\Route;
use App\Models\Invitado;

Route::view('/', 'welcome')->name('home');

Route::get('/invitacion/{token}', function ($token) {
    // Buscamos al invitado por su token único, si no existe lanza 404
    $invitado = Invitado::where('token', $token)->firstOrFail();
    
    return view('invite', compact('invitado'));
})->name('invitacion');

Route::prefix('{current_team}')
    ->middleware(['auth', 'verified', EnsureTeamMembership::class])
    ->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');
    });

Route::middleware(['auth'])->group(function () {
    Route::livewire('invitations/{invitation}/accept', 'pages::teams.accept-invitation')->name('invitations.accept');
});

require __DIR__.'/settings.php';
