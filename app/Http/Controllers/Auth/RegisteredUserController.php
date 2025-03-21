<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:20'], // Added phone validation
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // reCAPTCHA v2 response
            'g-recaptcha-response' => 'required',
        ]);

        // 2. Verify reCAPTCHA
        $captchaResponse = $request->input('g-recaptcha-response');
        $secretKey       = env('RECAPTCHA_KEY'); // Replace with your actual secret key
        $verifyURL       = 'https://www.google.com/recaptcha/api/siteverify';

        $response = file_get_contents($verifyURL . '?secret=' . $secretKey . '&response=' . $captchaResponse);
        $responseKeys = json_decode($response, true);

        if (!$responseKeys['success']) {
            return back()
                ->withErrors(['captcha' => 'ReCAPTCHA validation failed. Please try again.'])
                ->withInput();
        }
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone, // Storing phone from request
            'password' => Hash::make($request->password),
        ]);
        

        event(new Registered($user));
        $user->sendEmailVerificationNotification();
        return redirect()->route('verification.to.mail',$user->id);
        // Auth::login($user);

        // return redirect(route('dashboard', absolute: false));
    }
}
