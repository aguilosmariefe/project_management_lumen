<?php

namespace App\Http\Services;

use App\Models\Project;
use App\Models\Task;

class TaskService
{

    private ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }
    public function getAllByProject($projectId)
    {
        return $this->projectService->findById($projectId)
            ->tasks()
            ->latest()
            ->get();
    }

    public function findById($id)
    {
        return Task::findOrFail($id);
    }

    public function getByStatus(string $status)
    {
        return Task::where('status', $status)->get();
    }

    public function create(array $data,  $projectId)
    {
        $project = $this->projectService->findById($projectId);

        $task = $project->tasks()->create($data);

        return $task;
    }

    public function update(array $data, Task $task)
    {
        $task->update($data);

        return $task;
    }
}
