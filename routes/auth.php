<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use App\Livewire\TicketList;
use App\Livewire\TicketResponseForm;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {

    Volt::route('forgot-password', 'pages.auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'pages.auth.reset-password')
        ->name('password.reset');

});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');

     Volt::route('register', 'pages.auth.register')
        ->name('register');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'pages.auth.confirm-password')
        ->name('password.confirm');

    Volt::route('createticket','create-ticket')->name('createticket');

    Route::post('/tickets/{ticket}/claim', [TicketList::class,'claimTicket'])->name('claimticket');
    Route::get('/tickets/{ticket}/responder',  function (App\Models\Ticket $ticket) {
        return view('response', compact('ticket'));})->name('tickets.response');
});
