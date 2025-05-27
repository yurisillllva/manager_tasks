@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Cadastro</h2>

    @if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Nome
            </label>
            <input class="w-full px-3 py-2 border rounded"
                type="text"
                name="name"
                required
                autofocus>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                Email
            </label>
            <input class="w-full px-3 py-2 border rounded"
                type="email"
                name="email"
                required>
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

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
                Confirmar Senha
            </label>
            <input class="w-full px-3 py-2 border rounded"
                type="password"
                name="password_confirmation"
                required>
        </div>

        <button type="submit"
            class="w-full bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">
            Cadastrar
        </button>

    </form>

    <div class="mt-4 text-center">
        <p class="text-gray-600">Já tem uma conta?
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Faça login</a>
        </p>
    </div>
</div>
@endsection