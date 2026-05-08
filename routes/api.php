<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/signup', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout-other-devices', [AuthController::class, 'logoutOtherDevices']);
Route::post('/userdata',[AuthController::class, 'userData']);

