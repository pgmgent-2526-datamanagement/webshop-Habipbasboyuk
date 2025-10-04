<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WatchController;

Route::get('/', [WatchController::class, 'index']);
