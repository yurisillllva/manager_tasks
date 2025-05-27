<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Interfaces\TaskRepositoryInterface;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index(Request $request)
    {
        $tasks = $this->taskRepository->filterTasks(
            $request->status,
            $request->sort
        );

        return view('tasks.index', compact('tasks'));
    }

    public function store(TaskRequest $request)
    {
        $this->taskRepository->createTask($request->validated() + [
            'user_id' => auth()->id() // Alterado para auth() padrão
        ]);
        return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso!');
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function edit($id)
    {
        $task = $this->taskRepository->getTaskById($id);

        if ($task->user_id !== auth()->id()) {
            return redirect()->route('tasks.index')->with('error', 'Você não tem permissão para editar esta tarefa!');
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(TaskRequest $request, $id)
    {
        $task = $this->taskRepository->getTaskById($id);

        if ($task->user_id !== auth()->id()) {
            return redirect()->route('tasks.index')->with('error', 'Ação não autorizada!');
        }

        $this->taskRepository->updateTask($id, $request->validated());
        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $this->taskRepository->deleteTask($id);
        return redirect()->route('tasks.index')->with('success', 'Task deleted!');
    }
}
