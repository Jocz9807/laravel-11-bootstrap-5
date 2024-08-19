<?php

use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', function () {
    return view('vote');
});

Route::get('/vote', function () {
    return view('vote');
});

Route::post('/check-vote', [VoteController::class, 'checkVote'])->name('check-vote');
Route::post('/submit-vote', [VoteController::class, 'submitVote'])->name('submit-vote');
