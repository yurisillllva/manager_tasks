@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <!-- Filtros e Formulário -->
        <form action="{{ route('tasks.index') }}" method="GET" class="mb-6">
            <div class="flex gap-4">
                <select name="status" class="border rounded p-2 flex-1">
                    <option value="">All Status</option>
                    @foreach(['pendente', 'em andamento', 'concluída'] as $status)
                        <option @if(request('status') == $status) selected @endif>{{ $status }}</option>
                    @endforeach
                </select>
                <select name="sort" class="border rounded p-2 flex-1">
                    <option value="asc" @if(request('sort') == 'asc') selected @endif>Oldest First</option>
                    <option value="desc" @if(request('sort') == 'desc') selected @endif>Newest First</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
            </div>
        </form>

        <!-- Lista de Tarefas -->
        @foreach ($tasks as $task)
        <div class="border rounded p-4 mb-4">
            <h3 class="text-xl font-bold">{{ $task->title }}</h3>
            <p class="text-gray-600">{{ $task->description }}</p>
            <div class="flex justify-between items-center mt-4">
                <span class="px-2 py-1 rounded {{ $task->status == 'concluída' ? 'bg-green-200' : ($task->status == 'em andamento' ? 'bg-yellow-200' : 'bg-red-200') }}">
                    {{ $task->status }}
                </span>
                <div class="space-x-2">
                    <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500">Edit</a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

        {{ $tasks->links() }}
    </div>
</div>
@endsection