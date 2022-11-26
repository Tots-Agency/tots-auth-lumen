<?php

namespace Tots\Auth\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends \Laravel\Lumen\Routing\Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        return ['email' => $email];
    }
}
