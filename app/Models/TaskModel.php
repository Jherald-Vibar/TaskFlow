<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class TaskModel extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'tasks';

    protected $fillable = ['user_id', 'task_name', 'description', 'category_id', 'priority', 'due_date', 'due_time', 'completed_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(TaskCategoryModel::class, 'category_id');
    }


    public function progress()
    {
        return $this->hasOne(TaskProgress::class, 'task_id')->latest();
    }


    public function updateStatus()
    {
        $progress = $this->progress;
        $status = 'Pending';
        $completedAt = null;

        if ($progress) {
            if ($progress->progress_percentage == 100) {
                $status = 'Completed';
                $completedAt = now();
            } elseif ($progress->progress_percentage > 0) {
                $status = 'Ongoing';
            }
        }

        $previousStatus = $this->getOriginal('status');

        $this->update(['status' => $status, 'completed_at' => $completedAt]);

         if ($status !== $previousStatus) {
        activity()
            ->performedOn($this)
            ->causedBy(auth()->user())
            ->withProperties([
                'previous_status' => $previousStatus,
                'new_status' => $status,
            ])
            ->log("Task status changed from {$previousStatus} to {$status}");
        }
    }

    public function getActivitylogOptions(): LogOptions
    {

        return LogOptions::defaults()
            ->logOnly([
                'task_name',
                'description',
                'category_id',
                'priority',
                'due_date',
                'due_time',
                'status',
                'completed_at'
            ])
            ->useLogName('task')
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Task has been {$eventName}");
    }
}

