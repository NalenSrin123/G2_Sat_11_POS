<?php

namespace Modules\Auth\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Auth\Emails\SendOtpMail;
use Modules\Auth\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::with('role')
            ->where('email', $request->email)
            ->first();

        // 1. ឆែករក User
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        // 2. ឆែក Password
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Wrong password'
            ], 401);
        }

        // 3. ឆែកស្ថានភាពគណនី
        if (!$user->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Account inactive'
            ], 403);
        }

        // 4. បង្កើត និងរក្សាទុក OTP
        $otp = random_int(100000, 999999);

        $user->update([
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(5)
        ]);

        // 5. ផ្ញើអ៊ីមែល
        try {
            Mail::to($user->email)->send(new SendOtpMail($otp));
        } catch (\Exception $e) {
            // ការពារករណី Server Mail មានបញ្ហា កុំឱ្យគាំងទំព័រ Web
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP. Please try again.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully'
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required'
        ]);

        // ស្វែងរកតែ User តាម Email ប៉ុណ្ណោះជាមុនសិន
        $user = User::with('role')
            ->where('email', $request->email)
            ->first();

        // ប្រសិនបើមិនមាន User ឬ OTP ក្នុង DB ស្មើ null ឬ OTP វាយមកមិនត្រូវគ្នា
        if (!$user || is_null($user->otp) || $user->otp != (int)$request->otp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP'
            ], 401);
        }

        // ឆែកមើលថាតើ OTP ហួសកំណត់ហើយឬនៅ
        if (now()->gt($user->otp_expires_at)) {
            // បើហួសកំណត់ ត្រូវសម្អាត OTP ចោលតែម្តង
            $user->update([
                'otp' => null,
                'otp_expires_at' => null
            ]);

            return response()->json([
                'success' => false,
                'message' => 'OTP expired'
            ], 401);
        }

        // បង្កើត Token (Sanctum)
        $token = $user->createToken('api-token')->plainTextToken;

        // សម្អាត OTP ចេញបន្ទាប់ពីផ្ទៀងផ្ទាត់ជោគជ័យ
        $user->update([
            'otp' => null,
            'otp_expires_at' => null
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Login Success',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role->name ?? 'N/A'
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout Success'
        ]);
    }

    public function profile(Request $request)
    {
        return response()->json([
            'success' => true, // ថែមឱ្យមានទម្រង់ដូច API ផ្សេងទៀត
            'user' => $request->user()->load('role')
        ]);
    }
}