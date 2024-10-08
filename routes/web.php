<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\appController;
use App\Http\Controllers\Auth\adminController;


Route::get('/{vue?}', [appController::class, 'index'])->where('vue', '[\/\w\.-]*');
