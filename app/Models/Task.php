<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Task extends Model {

    const TODO = 'TODO';
    const DOING = 'DOING';
    const REVIEW = 'REVIEW';
    const DONE = 'DONE';

    protected $fillable = [
        'title',
        'description',
        'status',
        'estimated_hours',
        'started_at',
        'user_id'
    ];

    protected $attributes = [
        'status' => 'TODO',
        'started_at' => null
    ];

    protected function serializeDate(DateTimeInterface $date)
{
    return $date->format('Y-m-d H:i:s');
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
