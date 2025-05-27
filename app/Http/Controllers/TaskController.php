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
            'user_id' => auth('api')->user()->id
        ]);
        return redirect()->route('tasks.index')->with('success', 'Task created!');
    }

    public function update(TaskRequest $request, $id)
    {
        $this->taskRepository->updateTask($id, $request->validated());
        return redirect()->route('tasks.index')->with('success', 'Task updated!');
    }

    public function destroy($id)
    {
        $this->taskRepository->deleteTask($id);
        return redirect()->route('tasks.index')->with('success', 'Task deleted!');
    }
}
