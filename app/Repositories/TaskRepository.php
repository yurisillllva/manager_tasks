<?php

namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function getAllTasks($perPage = 7)
    {
        return Task::paginate($perPage);
    }

    public function getTaskById($id)
    {
        return Task::findOrFail($id);
    }

    public function createTask(array $details)
    {
        return Task::create($details);
    }

    public function updateTask($id, array $details)
    {
        $task = Task::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $task->update($details);
        return $task;
    }

    public function deleteTask($id)
    {
        return Task::destroy($id);
    }

    public function filterTasks($status, $sortBy)
    {
        return Task::where('user_id', auth()->id())
            ->when($status, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->orderBy('created_at', $sortBy ?? 'asc')
            ->paginate(7);
    }
}
