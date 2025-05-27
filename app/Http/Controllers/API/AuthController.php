<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user  = User::create($request->validated());

        Auth::login($user);

        $token = JWTAuth::fromUser($user);

        return redirect()
            ->route('tasks.index')
            ->withCookie(cookie('jwt_token', $token, (int) config('jwt.ttl')))
            ->with('success', 'Cadastro realizado com sucesso!');
    }


    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials)) {            // usa o guard padrão = web
            return back()
                ->withErrors(['email' => 'Credenciais inválidas'])
                ->withInput();
        }

        $user  = Auth::user();                          // já logado via sessão
        $token = JWTAuth::fromUser($user);              // gera JWT p/ requests AJAX

        return redirect()
            ->route('tasks.index')
            ->withCookie(cookie('jwt_token', $token, (int) config('jwt.ttl')));
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login')
            ->withoutCookie('jwt_token');
    }
}
