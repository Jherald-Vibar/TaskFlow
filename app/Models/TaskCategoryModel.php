<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskCategoryModel extends Model
{
    use HasFactory;
    protected $table = 'task_categories';

    protected $fillable = ['user_id', 'category_name',];
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class TaskCategoryModel extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'task_categories';

    protected $fillable = ['user_id', 'category_name'];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['category_name'])
            ->useLogName('task_category')
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Task category has been {$eventName}");
    }
>>>>>>> b0762e7 (Updated)

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tasks()
    {
        return $this->hasMany(TaskModel::class, 'category_id');
    }
}
