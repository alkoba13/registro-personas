<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\CopomexController;

Route::get('/person', [PersonController::class, 'index']);
Route::post('/person', [PersonController::class, 'store']);
Route::delete('/person/{id}', [PersonController::class, 'destroy']);

Route::get('/validateCP/{postalCode}', [CopomexController::class, 'validateCPAndGetState']);
