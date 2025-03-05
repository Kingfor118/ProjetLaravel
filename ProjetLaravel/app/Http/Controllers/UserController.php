<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserLogoutRequest;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $credential = $request->validated();
        $user = User::create($credential);

        $token = $user->createToken($request->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];

    }

    public function login(UserLoginRequest $credential)
    {
        $credential->validated();

        $user = User::where('email', $credential->email)->first();

        if(!$user || !Hash::check($credential->password, $user->password))
        {
            return[
                'message'=>'Mot de passe ou email incorrect'
            ];
        }

        $token = $user->createToken($user->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];

    }


    public function logout(UserLogoutRequest $credential)
    {
        $credential->user()->tokens()->delete();

        return [
            'message'=>'vous avez été déconnécté'
        ];
    }
}
