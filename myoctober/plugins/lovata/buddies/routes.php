<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Lovata\Buddies\Models\User;

Route::get("/api/data", function () {
    $data = User::all();
    return $data;
});

Route::post("api/login", function (Request $request) {
    $data = $request->only(['email', 'password']);

    $user = User::where('email', '=', $data['email'])->first();

    if ($user) {
        if (Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Success', 'data' => $user, 'status' => 1]);
        } else {
            return response()->json(['message' => 'Fail', 'status' => 0]);
        }
    } else {
        return response()->json(['message' => 'This user doesn\'t exist'], 201);
    }
});
