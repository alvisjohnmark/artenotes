<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\appController;


Route::get('/{vue?}', [appController::class, 'index'])->where('vue', '[\/\w\.-]*');

