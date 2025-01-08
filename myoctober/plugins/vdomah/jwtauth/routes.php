<?php

use RainLab\User\Models\User as UserModel;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Vdomah\JWTAuth\Models\Settings;

Route::group(['prefix' => 'api'], function () {

    Route::post('login', function (Request $request) {
        if (Settings::get('is_login_disabled'))
            App::abort(404, 'Page not found');

        $login_fields = Settings::get('login_fields', ['email', 'password']);

        $credentials = Input::only($login_fields);

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $userModel = JWTAuth::authenticate($token);

        if ($userModel->methodExists('getAuthApiSigninAttributes')) {
            $user = $userModel->getAuthApiSigninAttributes();
        } else {
            $user = [
                'id' => $userModel->id,
                'name' => $userModel->name,
                'surname' => $userModel->surname,
                'username' => $userModel->username,
                'email' => $userModel->email,
                'is_activated' => $userModel->is_activated,
            ];
            $status = 1;
        }
        return response()->json(compact('token', 'user', 'status'));
    });

    Route::post('refresh', function (Request $request) {
        if (Settings::get('is_refresh_disabled'))
            App::abort(404, 'Page not found');

        $token = Request::get('token');

        try {
            if (!$token = JWTAuth::refresh($token)) {
                return response()->json(['error' => 'could_not_refresh_token'], 401);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'could_not_refresh_token'], 500);
        }

        return response()->json(compact('token'));
    });

    Route::post('invalidate', function (Request $request) {
        if (Settings::get('is_invalidate_disabled'))
            App::abort(404, 'Page not found');

        $token = Request::get('token');

        try {
            JWTAuth::invalidate($token);
        } catch (Exception $e) {
            return response()->json(['error' => 'could_not_invalidate_token'], 500);
        }

        return response()->json('token_invalidated');
    });

    Route::post('signup', function (Request $request) {
        if (Settings::get('is_signup_disabled'))
            App::abort(404, 'Page not found');

        $login_fields = Settings::get('signup_fields', ['email', 'password', 'password_confirmation']);
        $credentials = Input::only($login_fields);

        try {
            $userModel = UserModel::create($credentials);

            if ($userModel->methodExists('getAuthApiSignupAttributes')) {
                $user = $userModel->getAuthApiSignupAttributes();
            } else {
                $user = [
                    'id' => $userModel->id,
                    'name' => $userModel->name,
                    'surname' => $userModel->surname,
                    'username' => $userModel->username,
                    'email' => $userModel->email,
                    'is_activated' => $userModel->is_activated,
                ];
            }
        } catch (Exception $e) {
            return Response::json(['error' => $e->getMessage()], 401);
        }

        $token = JWTAuth::fromUser($userModel);

        return Response::json(compact('token', 'user'));
    });
});
