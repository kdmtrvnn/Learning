<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use App\Mail\UserRegistered;

class RegisteredUserController extends Controller
{
    public function confirmEmail(Request $request, $token)
    {
        User::whereToken($token)->firstOrFail()->confirmEmail();
 
        $request->session()->flash('message', 'Учетная запись подтверждена. Войдите под своим именем.');
 
        return redirect('login');
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */

    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    
    public function store(Request $request)
    {
        $request->validate([
            'surname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'patronymic' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'captcha' => 'required|captcha',
        ]);

        $user = User::create($request->all());
 
        Mail::to($user->email)->send(new UserRegistered($user));
 
        $request->session()->flash('message', 'На ваш адрес было выслано письмо с подтверждением регистрации.');
 
        return redirect()->back();
    }
}
