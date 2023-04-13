<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return response($request->user(), Response::HTTP_CREATED);
        }

        return response([
            'email' => 'Bad email'
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
