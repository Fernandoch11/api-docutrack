<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usersaccessController;
use App\Http\Controllers\requestsController;

Route::group(['prefix' => 'auth'], function() {
    // Rutas públicas
    Route::post('login', [usersaccessController::class, 'login']);
    Route::post('register', [usersaccessController::class, 'register']);
    
    // Rutas protegidas
    Route::middleware('auth:api')->group(function() {
        Route::post('logout', [usersaccessController::class, 'logout']);
        Route::get('me', [usersaccessController::class, 'me']);
        Route::post('refresh', [usersaccessController::class, 'refreshToken']);
        Route::post('createrequest', [requestsController::class, 'createrequest']);
        Route::post('listrequests', [requestsController::class, 'listrequests']);
        Route::post('listrequestsAdmin', [requestsController::class, 'listrequestsAdmin']);
        Route::post('updateStatus', [requestsController::class, 'updateStatus']);
        Route::post('updateStatusComment', [requestsController::class, 'updateStatusComment']);
        Route::post('editrequest', [requestsController::class, 'editrequest']);
        Route::post('searchrequest', [requestsController::class, 'searchrequest']);
    });
});