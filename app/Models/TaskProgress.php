<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskProgress extends Model
{
    use HasFactory;

    protected $table = 'task_progress';

    protected $fillable = ['task_id', 'progress_percentage', 'status'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($progress) {
            $progress->status = $progress->determineStatus();
        });
    }

    public function determineStatus()
    {
        if ($this->progress_percentage == 0) {
            return 'Pending';
        } elseif ($this->progress_percentage < 100) {
            return 'Ongoing';
        } else {
            return 'Completed';
        }
    }

    public function task()
    {
        return $this->belongsTo(TaskModel::class);
    }
}

