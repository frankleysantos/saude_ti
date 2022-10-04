<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlanoSaudeController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth/plano-saude'
], function ($router) {
    Route::post('/store', [PlanoSaudeController::class, 'store']);
    Route::put('/update/{id}', [PlanoSaudeController::class, 'update']);
    Route::delete('/delete/{id}', [PlanoSaudeController::class, 'delete']); 
    Route::get('/show', [PlanoSaudeController::class, 'show'])->name('api.client.show'); 
});