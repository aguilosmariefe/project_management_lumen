<?php

namespace App\Http\Services;

use App\Models\Project;

class ProjectService
{
    public function all()
    {
        return Project::all();
    }

    public function getAssignees($id)
    {
        return $this->findById($id)->users;
    }

    public function findById($id)
    {
        return Project::findOrFail($id);
    }

    public function create(array $data)
    {
        $project =  Project::create(collect($data)->except('user_ids')->all());

        $project->users()->sync($data['user_ids']);

        return $project;
    }

    public function update(array $data, $id)
    {
        $project = $this->findById($id);

        $project->update(collect($data)->except('user_ids')->all());

        $project->users()->sync($data['user_ids']);

        return $project;
    }
}
