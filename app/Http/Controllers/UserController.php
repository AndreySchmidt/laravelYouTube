<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // return User::get(); добавлю сразу в модель пользователя как протектед свойство $with
        return User::with('channel')->get();
    }

    public function show(User $user)
    {
        return $user->load('channel');
        // return $user; подтягивание канала сделал автоматически через модель пользователя как протектед свойство $with
    }
}