<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ConsultaController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth/consulta'
], function ($router) {
    Route::post('/store', [ConsultaController::class, 'store']);
    Route::put('/update/{id}', [ConsultaController::class, 'update']);
    Route::delete('/delete/{id}', [ConsultaController::class, 'delete']); 
    Route::get('/show', [ConsultaController::class, 'show'])->name('api.client.show'); 
});