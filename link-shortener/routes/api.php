<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;

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

// Export links
Route::get('export_links', [LinkController::class, 'exportLinks']);

// Open a link
Route::get('link/{slug}', [LinkController::class, 'show']);

// Create new link
Route::post('link', [LinkController::class, 'store']);

// Import links
Route::post('import_links', [LinkController::class, 'importLinks']);

// Update link
Route::put('link/{id}', [LinkController::class, 'update']);

// Delete link
Route::delete('link/{id}', [LinkController::class,'destroy']);