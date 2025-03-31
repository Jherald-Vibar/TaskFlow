<?php

namespace App\Http\Controllers;

use App\Models\TaskModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function taskStore(Request $request) {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'taskName'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'required|date',
            'priority'    => 'required|in:Low,Medium,High',
            'category_id' => 'nullable|exists:task_categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $task = TaskModel::create([
            'task_name'   => $request->taskName,
            'description' => $request->description,
            'due_date'    => $request->due_date,
            'priority'    => $request->priority,
            'user_id'     => $user->id,
            'category_id' => $request->category_id ?: null,
        ]);

        return redirect()->route('user-today')->with('success', 'Task Created Successfully!');
    }
}
