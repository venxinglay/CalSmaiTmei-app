<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ResetPasswordRequest;

class AuthController extends Controller
{
    protected function register(Request $request)
    {
        /** @var User $user */
        $validatedData = $request->validate([
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validatedData['password'] = bcrypt($request->password);
        $user = User::create($validatedData);
        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json(['user' => $user, 'access_token' => $accessToken]);
    }

    protected function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!Auth::attempt($validatedData)) {
            return response(['message' => 'Invalid Credentials'], 400);
        }

        $accessToken = Auth::guard('web')->user()->createToken('authToken')->accessToken;
        return response()->json(['user' => Auth::guard('web')->user(), 'access_token' => $accessToken]);
    }

    public function forgot()
    {
        $email = request()->input(['email' => 'email']);

        if (User::where('email', $email)->doesntExist()) {
            return response()->json([
                'message' => 'Gmail doesn\'t Exist!'
            ], 400);
        }
        $token = Str::random(40);
        try {
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token
            ]);
            Mail::send('Mails.mail', ['token' => $token], function ($message) use ($email) {
                $message->to($email);
                $message->subject('Reset your password');
            });
            return response()->json(["message" => 'Reset password link sent on your email id.']);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()]);
        }
    }

    public function passwordReset(ResetPasswordRequest $request)
    {
        $token = request()->input(['token' => 'token']);

        if (!$passwordReset = DB::table('password_resets')->where('token', $token)->first()) {
            return response()->json(['message' => 'token is invalid']);
        }

        if (!$user = User::where('email', $passwordReset->email)->first()) {
            return response()->json(['message' => 'User do not exit']);
        }

        $user->password = bcrypt($request->input('password'));
        $user->save();

        return response()->json(["message" => "Save successfully"]);
    }
}
