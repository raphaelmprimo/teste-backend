<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// List links
Route::get('links', [LinkController::class, 'index']);

// Open a link
Route::get('link/{slug}', [LinkController::class, 'show']);

// Create new link
Route::post('link', [LinkController::class, 'store']);

// Update link
Route::put('link/{id}', [LinkController::class, 'update']);

// Delete link
Route::delete('link/{id}', [LinkController::class,'destroy']);