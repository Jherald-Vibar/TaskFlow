<?php

namespace App\Http\Controllers;

use App\Models\Account;
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

    public function updateTask(Request $request, $id) {

        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'taskName'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'required|date',
            'priority'    => 'required|in:Low,Medium,High',
            'category_id' => 'nullable|exists:task_categories,id',
        ]);
        if($validator->fails()) {
            dd($validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $task = TaskModel::where('id', $id)->where('user_id', $user->id)->first();
        if (!$task) {
            return redirect()->back()->with('error', 'Task not found or unauthorized.');
        }
        $task->update([
            'task_name'   => $request->taskName,
            'description' => $request->description,
            'due_date'    => $request->due_date,
            'priority'    => $request->priority,
            'category_id' => $request->category_id ?: null,
        ]);
        return redirect()->route('user-today')->with('success', 'Updating Task Successful!');
    }

    public function deleteTask($id) {
        $task = TaskModel::find($id);

        if(!$task) {
            return redirect()->back()->with('error', "Task not found");
        }

        $task->delete();
        return redirect()->route('user-today')->with('success', "Deleted Task Successful!");
    }


    public function searchTask(Request $request) {
        $title = "Today Task";
        $user = Auth::user();
        $query = $request->input('query');
        $account = Account::where('user_id', $user->id)->first();
        $tasks = TaskModel::where('task_name', 'LIKE', "%$query%")
        ->where('user_id', $user->id)
        ->get();


        return view('users.today', compact('tasks', 'account', 'title'));
    }
}
