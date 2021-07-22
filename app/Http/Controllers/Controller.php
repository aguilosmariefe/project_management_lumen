<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'user' => Auth::user(),
            'token_type' => 'Bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ], 200);
    }
}
