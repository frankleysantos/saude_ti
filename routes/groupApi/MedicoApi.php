<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MedicoController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth/medico'
], function ($router) {
    Route::post('/store', [MedicoController::class, 'store']);
    Route::put('/update/{id}', [MedicoController::class, 'update']);
    Route::delete('/delete/{id}', [MedicoController::class, 'delete']); 
    Route::get('/show', [MedicoController::class, 'show'])->name('api.client.show'); 
});