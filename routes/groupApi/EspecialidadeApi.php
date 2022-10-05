<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EspecialidadeController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth/especialidade'
], function ($router) {
    Route::post('/store', [EspecialidadeController::class, 'store']);
    Route::put('/update/{id}', [EspecialidadeController::class, 'update']);
    Route::delete('/delete/{id}', [EspecialidadeController::class, 'delete']); 
    Route::get('/show', [EspecialidadeController::class, 'show'])->name('api.client.show'); 
});