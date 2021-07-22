<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    protected $fillable = [
        'title',
        'description',
        'timeline',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
