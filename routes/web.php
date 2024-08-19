<?php

use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', function () {
    return view('vote');
});

Route::post('/check-vote', [VoteController::class, 'checkVote'])->name('check-vote');
Route::post('/submit-vote', [VoteController::class, 'submitVote'])->name('submit-vote');

Route::get('/result', [VoteController::class, 'result'])->name('results');
