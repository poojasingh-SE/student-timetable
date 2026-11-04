<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function callback()
    {

        //fetch google user's accounts list 
        $googleUser = Socialite::driver('google')->user();
        
    
        // Google identity aur verified email check karo
        if (
            !$googleUser->getId() ||
            !$googleUser->getEmail() ||
            !($googleUser->user['verified_email'] ?? false)
        ) {
            return redirect('/login')
                ->withErrors([
                    'email' => 'Google email verification failed.',
                ]);
        }
    
        // Pehle Google ID se existing user find karo
        $user = User::where('google_id', $googleUser->getId())->first();
        

    
        if (!$user) {
            // Email pehle se hai toh wahi account use karo
            $user = User::where('email', $googleUser->getEmail())->first();
    
            if ($user) {
                $user->google_id = $googleUser->getId();
                $user->save();
            } else {
                // Naya Google user create karo
                $user = User::create([
                    'name' => $googleUser->getName() ?: 'Student',
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Str::random(40),
                ]);
            }
        }
    
        // Laravel mein login session create karo
        Auth::login($user); #normal login and session based 
        Auth::login($user, true); #persistent login, Laravel remember cookie generate karega.
        request()->session()->regenerate();
    
        return redirect()->intended(route('dashboard'));
    }
    

    public function linkRedirect()
    {
        return Socialite::driver('google')
            ->redirectUrl(route('google.link.callback'))
            ->scopes([
                'openid',
                'profile',
                'email',
                'https://www.googleapis.com/auth/calendar.events.readonly',
            ])
            ->with([
                'access_type' => 'offline',
                'prompt' => 'consent',
                'include_granted_scopes' => 'true',
            ])
            ->redirect();
    }

    public function linkCallback()
    {
        $googleUser = Socialite::driver('google')
            ->redirectUrl(route('google.link.callback'))
            ->user();

        $user = auth()->user();

        $existingToken = $user->googleCalendarToken;

        $user->googleCalendarToken()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'access_token' => $googleUser->token,

                'refresh_token' => $googleUser->refreshToken
                    ?: $existingToken?->refresh_token,

                'expires_at' => now()->addSeconds(
                    $googleUser->expiresIn
                ),
            ]
        );

        return redirect()->route('dashboard')
            ->with('success', 'Google Calendar connected successfully!');
    }
}

