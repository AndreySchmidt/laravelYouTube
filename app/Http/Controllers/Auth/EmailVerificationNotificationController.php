<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailVerificationNotificationController extends Controller
{
    public function store(Request $request)
    {
        if($request->user()->hasVerifiedEmail())
        {
            return response(['message' => 'Email has been verified']);
        }
        $request->user()->sendEmailVerificationNotification();

        return response([
            'message' => 'A new verification link has been send to the email address you provided'
        ]);
    }
}
