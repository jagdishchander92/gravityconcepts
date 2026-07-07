<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        // 1. Validate the incoming request
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        // 2. Check the "Remember Me" checkbox
        $remember = $request->has('remember');

        // 3. Attempt to log the user in
        if (Auth::attempt($credentials, $remember)) {
            // Regenerate session to prevent fixation attacks
            $request->session()->regenerate();

            // Redirect to intended page or dashboard
            return redirect()->route('admin.user-index')->with('success', 'Welcome back!');
        }

        // 4. If login fails, redirect back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        // 1. Generate a 6-digit OTP
        $otp = rand(100000, 999999);

        // 2. Store OTP and Email in session with an expiration (e.g., 5 mins)
        session([
            'reset_otp' => $otp,
            'reset_email' => $request->email,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        // 3. Send Email (Replace with your Mailable)
        // Mail::to($request->email)->send(new OtpMail($otp));
        info("The otp is", [$otp]);

        return response()->json(['message' => 'OTP sent to your email.']);
    }
    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        // Check if OTP exists and hasn't expired
        /** @var string|\DateTimeInterface $expiresAt */
        $expiresAt = session('otp_expires_at');
        if (session('reset_otp') == $request->otp && now()->isBefore($expiresAt)) {
            session(['otp_verified' => true]);
            return response()->json(['message' => 'OTP verified successfully.']);
        }

        return response()->json(['message' => 'Invalid or expired OTP.'], 422);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        if (!session('otp_verified')) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $user = User::where('email', session('reset_email'))->first();
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        // Clear session
        session()->forget(['reset_otp', 'reset_email', 'otp_expires_at', 'otp_verified']);

        return response()->json(['message' => 'Password updated successfully!']);
    }

    public function showForgotPage()
    {
        return view('auth.forgot-password');
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }
    public function editProfileSave(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
