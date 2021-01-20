<?php

namespace Modules\App\Auth\Controllers;

use Modules\App\Auth\Models\AuthModel;

class AuthController
{
    public function __construct()
    {
        # code...
    }

    public function refresh()
    {
        try {
            $res = AuthModel::refresh();

            return json_response([
                'status' => $res->status,
                'token' => $res->jwt,
                'data' => $res->data
            ]);
        } catch (\Throwable $th) {
            return catchException($th);
        }
    }

    public function signIn()
    {
        try {
            $res = AuthModel::signIn();

            return json_response([
                'status' => true,
                'token' => $res->jwt,
                'data' => [
                    'name' => $res->user->getName(),
                    'email' => $res->user->getEmail(),
                    'avatar' => $res->user->getAvatar(true)
                ]
            ]);
        } catch (\Throwable $th) {
            return catchException($th);
        }
    }

    public function signUp()
    {
        try {
            $res = AuthModel::signUp();

            return json_response([
                'status' => true,
                'token' => $res->jwt,
                'data' => [
                    'name' => $res->user->getName(),
                    'email' => $res->user->getEmail(),
                    'avatar' => $res->user->getAvatar(true)
                ]
            ]);
        } catch (\Throwable $th) {
            return catchException($th);
        }
    }

    public function signOut()
    {
        try {
            AuthModel::signOut();
            return json_response([
                'status' => true
            ]);
        } catch (\Throwable $th) {
            return catchException($th);
        }
    }
}
