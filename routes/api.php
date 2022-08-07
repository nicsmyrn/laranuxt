<?php

use App\Http\Controllers\BasicInfioController;
use App\Http\Controllers\BasicInfoController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\WorkHistoryController;
use Illuminate\Support\Facades\Route;


Route::resource('skills', SkillController::class);
Route::resource('works', WorkHistoryController::class);

Route::prefix('interests')->group(function(){
    Route::get('/', [InterestController::class, 'index'])->name('interest.index');
    Route::post('/', [InterestController::class, 'store'])->name('interest.store');
    Route::delete('/{interest}', [InterestController::class, 'destroy'])->name('interest.destroy');
});


Route::prefix('basic-info')->group(function(){
    Route::get('/', [BasicInfoController::class, 'getInfo'])->name('info.get');
    Route::patch('/update', [BasicInfoController::class, 'update'])->name('info.update');
    Route::post('create', [BasicInfoController::class, 'store'])->name('info.store');
});

Route::get('/', [Controller::class, 'routes'])
    ->name('route information')
    ->withoutMiddleware('api');
Route::get('/example', [Controller::class, 'example'])->name('example route');
Route::get('/error', [Controller::class, 'error'])->name('error route');
