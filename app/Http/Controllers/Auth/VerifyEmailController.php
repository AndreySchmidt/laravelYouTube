<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request)
    {
        if($request->user()->hasVerifiedEmail())
        {
            return response(['message' => 'Email has been verified']);
        }

        $request->user()->markEmailAsVerified();

        return response(['message'=>'Email has been verified']);
    }
}
