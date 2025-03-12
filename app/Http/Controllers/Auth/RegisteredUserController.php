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

use Twilio\Rest\Client as TwilioClient;

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
            'phone' => ['required','numeric'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'phone' => $request->phone
        // ]);

        // Generate OTP
        $otp = rand(100000, 999999);

        // 3. Temporarily store data in session
        $pendingUserData = $request->only(['name', 'phone', 'email', 'password']);
        $pendingUserData['otp'] = $otp;
        session(['pendingUser' => $pendingUserData]);

        // 4. Send OTP via Twilio
        $this->sendOtp($request->phone, $otp);

        // event(new Registered($user));
        
        return redirect()->route('otp.verify')->with('status', 'We have sent an OTP to your phone.');
        // Auth::login($user);

        // return redirect(route('dashboard', absolute: false));
    }

    protected function sendOtp($phone, $otp)
    {
        $sid    = config('services.twilio.sid');
        $token  = config('services.twilio.token');
        $from   = config('services.twilio.from');

        $twilio = new TwilioClient($sid, $token);
        $message = "Your verification code is: $otp";

        $twilio->messages->create($phone, [
            'from' => $from,
            'body' => $message,
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        // Retrieve pending user data from session
        $pendingUser = session('pendingUser');

        if (!$pendingUser) {
            return redirect()->route('register')->withErrors([
                'otp' => 'Session expired. Please register again.',
            ]);
        }

        // Compare OTP
        if ($request->otp == $pendingUser['otp']) {
            // Create the user in DB
            $user = User::create([
                'name' => $pendingUser['name'],
                'email' => $pendingUser['email'],
                'phone' => $pendingUser['phone'],
                'password' => Hash::make($pendingUser['password']),
                'is_phone_verified' => true,
            ]);

            // Log the user in
            Auth::login($user);

            // Clear session
            session()->forget('pendingUser');

            return redirect()->route('dashboard')->with('status', 'Phone verified successfully!');
        } else {
            return back()->withErrors([
                'otp' => 'Invalid OTP. Please try again.',
            ]);
        }
    }

}
