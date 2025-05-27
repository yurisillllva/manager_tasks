@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

    @if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
    @endif


    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                Email
            </label>
            <input class="w-full px-3 py-2 border rounded"
                type="email"
                name="email"
                required
                autofocus>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Senha
            </label>
            <input class="w-full px-3 py-2 border rounded"
                type="password"
                name="password"
                required>
        </div>

        <button type="submit"
            class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            Entrar
        </button>
        @if (Route::has('register'))
        <div class="mt-4 text-center">
            <p class="text-gray-600">Não tem uma conta?
                <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Cadastre-se</a>
            </p>
        </div>
        @endif
    </form>
</div>
@endsection