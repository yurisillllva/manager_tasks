<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <nav class="bg-blue-600 p-4 w-full">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            <a href="{{ route('tasks.index') }}" class="text-white text-xl font-bold">Gerenciador de Tarefas</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="text-white hover:text-gray-200 bg-blue-700 px-4 py-2 rounded">
                    Sair
                </button>
            </form>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        @yield('content')
    </div>
</body>

</html>