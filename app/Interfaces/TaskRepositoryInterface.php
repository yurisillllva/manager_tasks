<?php

namespace App\Interfaces;

interface TaskRepositoryInterface
{
    public function getAllTasks($perPage = 7);
    public function getTaskById($id);
    public function createTask(array $details);
    public function updateTask($id, array $details);
    public function deleteTask($id);
    public function filterTasks($status, $sortBy);
}