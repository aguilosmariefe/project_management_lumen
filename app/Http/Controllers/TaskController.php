<?php

namespace App\Http\Controllers;

use App\Http\Services\TaskService;
use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{

    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index($projectId)
    {
        return $this->taskService->getAllByProject($projectId);
    }

    public function show($id)
    {
        return $this->taskService->findById($id);
    }

    public function store(Request $request, $projectId)
    {
        $validated = $this->validateRequest($request);

        return $this->taskService->create($validated, $projectId);
    }

    public function update(Request $request, $id)
    {
        $task = $this->taskService->findById($id);

        $validated = $this->validate($request, [
            'title' => 'required|unique:tasks,title,'. $id .',id',
            'description' => 'required',
            'status' => 'required',
            'estimated_hours' => 'sometimes|integer',
            'started_at' => 'sometimes|date',
            'user_id' => 'required|exists:users,id'
        ]);

        if ($validated['status'] == Task::DOING && !$task->started_at) {
            Carbon::setLocale('en_PH');
            $validated['started_at'] = Carbon::now();
        }

        if ($validated['status'] == Task::REVIEW) {
            $validated['started_at'] = null;
        }

        return $this->taskService->update($validated, $task);
    }

    private function validateRequest(Request $request, Number $id = null)
    {
        return $this->validate($request, [
            'title' => 'required|unique:tasks,title',
            'description' => 'required',
            'status' => 'required',
            'estimated_hours' => 'sometimes|integer',
            'started_at' => 'sometimes|date',
            'user_id' => 'required|exists:users,id'
        ]);
    }
}
