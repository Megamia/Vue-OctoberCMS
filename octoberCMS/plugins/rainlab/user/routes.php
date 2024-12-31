<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use RainLab\User\Models\User;

Route::get("api/data", function () {
    $data = User::all();
    return response()->json($data);
});

Route::post("api/login", function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return response()->json([
            'message' => 'Login successful',
            'user' => Auth::user(),
        ]);
    } else {
        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }
});
