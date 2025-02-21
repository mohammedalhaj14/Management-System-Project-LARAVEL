<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request data
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $fields['email'], 'password' => $fields['password']], $request->has('remember'))) {
            if (Auth::user()->role === 'admin') {
                return redirect('/dashboard');
            } elseif (Auth::user()->role === 'student') {
                return redirect('/studentPage');
            } else {
                return to_route('teacher');
            }
        }
    }

    public function logout()
    {
        // Log the user out
        Auth::logout();
        return redirect('/');
    }
    public function verifyNotice()
    {
        return view('auth.verify-email');
    }
    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('/dashboard');
    }
    public function resendEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
    public function image(Request $request)
    {
        $fields = $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2084', 'dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000'],
        ]);
        $randomName = Str::random(12);
        $imageName = 'IMG_' . $randomName . '.' . $fields['image']->extension();
        $fields['image']->storeAs('images', $imageName);
        Image::create([
            'image' => $imageName,
        ]);
    }
}
