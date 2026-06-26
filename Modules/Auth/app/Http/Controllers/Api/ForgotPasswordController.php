<?php

namespace Modules\Auth\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;


class ForgotPasswordController extends Controller
{
    // SEND RESET PASSWORD EMAIL
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // CHECK USER
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Email not found'
            ], 404);
        }

        // GENERATE TOKEN
        $token = Str::random(64);

        // DELETE OLD TOKEN
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        // INSERT TOKEN
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        // RESET LINK
        $resetLink = url('/reset-password?token=' . $token . '&email=' . $request->email);

        // SEND EMAIL
        Mail::raw(
            "Click this link to reset your password:\n\n" . $resetLink,
            function ($message) use ($request) {
                $message->to($request->email)
                    ->subject('Reset Password');
            }
        );

        return response()->json([
            'status' => true,
            'message' => 'Reset password link sent to email'
        ]);
    }

    // RESET PASSWORD
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        // CHECK TOKEN
        $checkToken = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$checkToken) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid token'
            ], 400);
        }

        // TOKEN EXPIRE 15 MINUTES
        if (Carbon::parse($checkToken->created_at)
            ->addMinutes(15)
            ->isPast()) {

            return response()->json([
                'status' => false,
                'message' => 'Token expired'
            ], 400);
        }

        // UPDATE PASSWORD
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        // DELETE TOKEN
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return response()->json([
            'status' => true,
            'message' => 'Password reset successfully'
        ]);
    }
}