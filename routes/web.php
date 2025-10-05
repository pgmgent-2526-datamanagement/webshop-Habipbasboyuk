<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WatchController;
use App\Http\Controllers\FindController;

Route::get('/', [WatchController::class, 'index']);
Route::get('/findwatch', [FindController::class, 'index']);
