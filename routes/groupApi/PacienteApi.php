<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PacienteController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth/paciente'
], function ($router) {
    Route::post('/store', [PacienteController::class, 'store']);
    Route::put('/update/{id}', [PacienteController::class, 'update']);
    Route::delete('/delete/{id}', [PacienteController::class, 'delete']); 
    Route::get('/show', [PacienteController::class, 'show'])->name('api.client.show'); 
});