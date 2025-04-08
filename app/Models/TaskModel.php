<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = ['user_id', 'task_name', 'description', 'category_id', 'priority', 'due_date', 'due_time'];

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

        if ($progress) {
            if ($progress->progress_percentage == 100) {
                $status = 'Completed';
            } elseif ($progress->progress_percentage > 0) {
                $status = 'Ongoing';
            }
        }

        $this->update(['status' => $status]);
    }
}

