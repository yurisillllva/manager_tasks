@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-4">Criar Nova Tarefa</h1>
        
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Título</label>
                <input type="text" name="title" 
                    class="w-full px-3 py-2 border rounded"
                    required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Descrição</label>
                <textarea name="description"
                    class="w-full px-3 py-2 border rounded"
                    rows="4"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                <select name="status" class="w-full px-3 py-2 border rounded">
                    @foreach(['pendente', 'em andamento', 'concluída'] as $status)
                        <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Criar Tarefa
            </button>
        </form>
    </div>
</div>
@endsection