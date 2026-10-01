<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\WebhookController;

Route::post('/login', [AuthController::class, 'login']);

// Dummy Webhook endpoint for Demo (Open API)
Route::post('/v1/webhook/cricclubs', [WebhookController::class, 'handleCricClubs']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});
