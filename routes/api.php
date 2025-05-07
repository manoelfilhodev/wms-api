<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArmazenagemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Credenciais inválidas'], 401);
    }

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json(['token' => $token]);
});

Route::middleware('auth:sanctum', 'auth.api')->group(function () {
    Route::apiResource('armazenagens', ArmazenagemController::class);
});