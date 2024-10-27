<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Socialite as ModelSocialite;

class SocialiteController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {

        $socialUser = Socialite::driver($provider)->user();

        $authuser = $this->store($socialUser, $provider);

        Auth::login($authuser);

        return redirect('/');
    }

    public function store($socialUser, $provider)
    {
        // Check if the social account already exists
        $socialAccount = ModelSocialite::where('provider_id', $socialUser->getId())
            ->where('provider_name', $provider)
            ->first();

        // If the social account doesn't exist, create a new user and social account
        if (!$socialAccount) {
            // Check if a user with the same email exists
            $user = User::where('email', $socialUser->getEmail())->first();

            // If the user doesn't exist, create a new one
            if (!$user) {
                // Generate a base username from Google name or nickname
                $baseUsername = $socialUser->getName() ?: $socialUser->getNickname();
                $baseUsername = Str::slug($baseUsername);

                // Check if username already exists and append a unique number if it does
                $username = $baseUsername;
                $counter = 1;
                while (User::where('username', $username)->exists()) {
                    $username = $baseUsername . $counter;
                    $counter++;
                }

                // Retrieve phone number from raw Google data if available
                $phone = $socialUser->user['phoneNumber'] ?? null; // Adjust key if different

                // Create the new user with generated username and possibly phone
                $user = User::create([
                    'id' => (string) Str::uuid(),
                    'name' => $socialUser->getName() ?: $socialUser->getNickname(),
                    'email' => $socialUser->getEmail(),
                    'username' => $username,
                    'phone' => $phone,
                    'password' => bcrypt(Str::random(24)),
                ]);

                // Assign the default role 'user' to the new user
                $user->assignRole('user'); // Ensure 'user' role exists
            }

            // Create the social account
            $socialAccount = $user->socialite()->create([
                'id' => (string) Str::uuid(),
                'provider_id' => $socialUser->getId(),
                'provider_name' => $provider,
                'provider_token' => $socialUser->token,
                'provider_refresh_token' => $socialUser->refreshToken,
            ]);

            return $user;
        }

        // If the social account exists, return the associated user
        return $socialAccount->user;
    }
}
