<?php

namespace App\Console\Commands;

use App\Models\Notification;
use App\Models\TaskModel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class NotifyTasksDueTomorrow extends Command
{
    protected $signature = 'tasks:notify-due-tomorrow';
    protected $description = 'Notify users of tasks due tomorrow';

    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->startOfDay();

        $tasks = TaskModel::whereDate('due_date', $tomorrow)->get();

        foreach ($tasks as $task) {
            $user = $task->user;

            Notification::create([
                'user_id' => $user->id,
                'task_id' => $task->id,
                'messages' => "⏰ Task '{$task->task_name}' is due tomorrow!",
            ]);

            $notif = Notification::where('user_id', $user->id)->whereHas('task')->where('task_id', $task->id)->get();

            Mail::send('emails.due-task-email', [
                'user' => $user,
                'task' => $task,
                'notif' => $notif
            ], function ($message) use ($user, $task) {
                $message->to($user->email)
                        ->subject("Reminder: '{$task->task_name}' is due tomorrow!");
            });
        }

        $this->info("Task due notifications sent successfully.");
    }
}
