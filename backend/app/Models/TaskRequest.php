<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskRequest extends Model
{
    protected $fillable = [
        'requested_by', 'task_id', 'status', 'requested_at', 'reviewed_at'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
}
