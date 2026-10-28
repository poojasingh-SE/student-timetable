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
        Auth::login($user);
        request()->session()->regenerate();
    
        return redirect()->intended(route('dashboard'));
    }
    

    public function linkRedirect()
    {
        return Socialite::driver('google')
            ->redirectUrl(route('google.link.callback'))
            ->redirect();
    }
}

