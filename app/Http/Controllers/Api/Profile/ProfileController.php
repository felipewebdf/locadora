<?php

namespace App\Http\Controllers\Api\Profile;

use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    public function test(Request $params)
    {
        $user = JWTAuth::parseToken()->authenticate();
        dd($user);
    }

}
