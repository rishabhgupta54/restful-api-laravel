<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APILoginController extends APIController {
    public function index(Request $request) {
        $this->validate($request, [
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
            ],
        ]);

        $login = $request->only([
            'email',
            'password',
        ]);

        if (Auth::attempt($login)) {
            $accessToken = Auth::user()->createToken('accessToken')->accessToken;
        }

        $data = [
            'user' => Auth::user(),
            'accessToken' => $accessToken,
        ];

        return $this->successResponse($data, 200);

    }
}
