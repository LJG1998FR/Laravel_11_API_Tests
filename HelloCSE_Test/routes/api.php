<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('getActiveUsers', [UsersController::class, 'getActiveUsers']);//->middleware('client');

Route::post('storeNewUser', [UsersController::class, 'storeNewUser']);
Route::put('updateUser', [UsersController::class, 'updateUser']);
Route::delete('deleteUser', [UsersController::class, 'deleteUser']);