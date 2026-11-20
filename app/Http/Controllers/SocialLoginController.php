<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $socialLoginData = Socialite::driver($provider)->user();

        $user = User::updateOrCreate(
            [
                 'provider_id' => $socialLoginData->id,

            ],
            [
                'name' => $socialLoginData->name,
                'nickname' => $socialLoginData->nickname,
                'email' => $socialLoginData->email,
                // 'profile' => $socialLoginData->avatar,
                'provider' => $provider,//github google
                'provider_id' => $socialLoginData->id,
                'provider_token' => $socialLoginData->token,
                'role' => 'user',
            ]
        );

        Auth::login($user);

        // return to_route('admin#dashboard');
           return to_route('user#homePage');
    }
}

