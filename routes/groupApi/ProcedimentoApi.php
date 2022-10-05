<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProcedimentoController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth/procedimento'
], function ($router) {
    Route::post('/store', [ProcedimentoController::class, 'store']);
    Route::put('/update/{id}', [ProcedimentoController::class, 'update']);
    Route::delete('/delete/{id}', [ProcedimentoController::class, 'delete']); 
    Route::get('/show', [ProcedimentoController::class, 'show'])->name('api.client.show'); 
});