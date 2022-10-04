<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VinculoController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth/vinculo'
], function ($router) {
    Route::post('/store', [VinculoController::class, 'store']);
    Route::post('/update/{id}', [VinculoController::class, 'update']);
    Route::delete('/delete/{id}', [VinculoController::class, 'delete']); 
    Route::get('/show', [VinculoController::class, 'show'])->name('api.client.show'); 
});