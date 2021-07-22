<?php

namespace App\Http\Controllers;

use App\Http\Services\ProjectService;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    private ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index()
    {
        return $this->projectService->all();
    }

    public function show($id)
    {
        return $this->projectService->findById($id);
    }

    public function getAssignees($id)
    {
        return $this->projectService->getAssignees($id);
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        return $this->projectService->create($validated);
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateRequest($request);

        return $this->projectService->update($validated, $id);
    }

    private function validateRequest(Request $request)
    {
        return $this->validate($request, [
            'title' => 'required|unique:projects,title',
            'description' => 'required',
            'timeline' => 'required',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);
    }
}
