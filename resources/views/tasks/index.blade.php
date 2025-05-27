@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Suas Tarefas</h2>
            <a href="{{ route('tasks.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Nova Tarefa
            </a>
        </div>
        <form action="{{ route('tasks.index') }}" method="GET" class="mb-6">
            <div class="flex gap-4">
                <select name="status" class="border rounded p-2 flex-1">
                    <option value="">Todos Status</option>
                    @foreach(['pendente', 'em andamento', 'concluída'] as $status)
                    <option @if(request('status')==$status) selected @endif>{{ $status }}</option>
                    @endforeach
                </select>
                <select name="sort" class="border rounded p-2 flex-1">
                    <option value="asc" @if(request('sort')=='asc' ) selected @endif>Mais antiga</option>
                    <option value="desc" @if(request('sort')=='desc' ) selected @endif>Mais nova</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filtrar</button>
            </div>
        </form>

        <!-- Lista de Tarefas -->
        @foreach ($tasks as $task)
        <div class="border rounded p-4 mb-4">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-xl font-bold">{{ $task->title }}</h3>
                    <p class="text-gray-600">{{ $task->description }}</p>
                    <div class="mt-2 text-sm text-gray-500">
                        Criado em: {{ $task->created_at->format('d/m/Y H:i') }}
                        @if($task->created_at != $task->updated_at)
                        | Atualizado em: {{ $task->updated_at->format('d/m/Y H:i') }}
                        @endif
                    </div>
                </div>
                <div class="space-x-2 flex items-center flex-shrink-0">
                    @if($task->user_id === auth()->id())
                    <a href="{{ route('tasks.edit', $task->id) }}"
                        class="text-blue-500 hover:text-blue-700 whitespace-nowrap">
                        Editar
                    </a>
                    <span class="text-gray-300">|</span>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-red-500 hover:text-red-700 whitespace-nowrap"
                            onclick="return confirm('Tem certeza que deseja excluir?')">
                            Excluir
                        </button>
                    </form>
                    @else
                    <span class="text-gray-400 italic">Apenas leitura</span>
                    @endif
                </div>
            </div>
            <div class="mt-2">
                <span class="px-2 py-1 rounded {{ $task->status == 'concluída' ? 'bg-green-200' : ($task->status == 'em andamento' ? 'bg-yellow-200' : 'bg-red-200') }}">
                    {{ $task->status }}
                </span>
            </div>
        </div>
        @endforeach

        {{ $tasks->links() }}
    </div>
</div>
@endsection