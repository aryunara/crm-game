<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        return view('menu');
    }

    public function postLogin(LoginRequest $request)
    {
        $validated = $request->validated();

        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        if (Auth::attempt($credentials)) {
            return redirect('main');
        }

        return redirect()->back()->withErrors([
            'email' => 'Incorrect login information entered.',
        ]);
    }

    public function postRegister(RegistrationRequest $request)
    {
        $validated = $request->validated();

        try {
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'email_verified_at' => null,
            ]);

            return redirect("menu")->withSuccess('Регистрация прошла успешно.');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return redirect()->back()->with('Во время регистрации возникла ошибка на сервере.');
        }
    }
}
