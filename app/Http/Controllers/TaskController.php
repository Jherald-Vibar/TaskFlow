<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\TaskCategoryModel;
use App\Models\TaskModel;
use App\Models\TaskProgress;
use App\Rules\TimeFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
            'due_time' => ['nullable', new TimeFormat],
            'priority'    => 'required|in:Low,Medium,High',
            'category_id' => 'nullable|exists:task_categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dueTime = $request->due_time ? \Carbon\Carbon::createFromFormat('H:i', $request->due_time)->format('H:i:s') : null;

        $task = TaskModel::create([
            'task_name'   => $request->taskName,
            'description' => $request->description,
            'due_date'    => $request->due_date,
            'due_time' => $dueTime,
            'priority'    => $request->priority,
            'user_id'     => $user->id,
            'category_id' => $request->category_id ?: null,
        ]);

        TaskProgress::create([
            'task_id' => $task->id,
            'progress_percentage' => 0,
            'status'  => 'Pending',
        ]);

        return redirect()->route('user-task')->with('success', 'Task Created Successfully!');
    }

    public function updateTask(Request $request, $id) {

        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'taskName'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'required|date',
            'due_time' => ['nullable', new TimeFormat],
            'priority'    => 'required|in:Low,Medium,High',
            'category_id' => 'nullable|exists:task_categories,id',
            'progress_percentage' => 'nullable|integer|min:0|max:100',
            'status' => 'nullable|in:Pending,Ongoing,Completed',
        ]);

        if($validator->fails()) {
            dd($validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $task = TaskModel::where('id', $id)->where('user_id', $user->id)->first();

        if (!$task) {
            return redirect()->back()->with('error', 'Task not found or unauthorized.');
        }

        $dueTime = $request->due_time ?: $task->due_time;

        $task->update([
            'task_name'   => $request->taskName,
            'description' => $request->description,
            'due_date'    => $request->due_date,
            'due_time'    => $dueTime,
            'priority'    => $request->priority,
            'category_id' => $request->category_id ?: null,
        ]);

        $task->progress()->updateOrCreate(
            ['task_id' => $task->id],
            [
                'progress_percentage' => $request->progress_percentage ?? 0,
                'status' => $request->status ?? 'Pending',
            ]
        );
        return redirect()->route('user-task')->with('success', 'Updating Task Successful!');
    }

    public function deleteTask($id) {
        $task = TaskModel::find($id);

        if(!$task) {
            return redirect()->back()->with('error', "Task not found");
        }

        $task->delete();
        return redirect()->route('user-task')->with('success', "Deleted Task Successful!");
    }


    public function searchTask(Request $request) {
        $title = "My Task";
        $user = Auth::user();
        $query = $request->input('query');
        $account = Account::where('user_id', $user->id)->first();
        $categories = TaskCategoryModel::where('user_id', $user->id)->get();
        $tasks = TaskModel::where('task_name', 'LIKE', "%$query%")
        ->where('user_id', $user->id)
        ->paginate(5);


        return view('Users.task', compact('tasks', 'account', 'title', 'categories'));
    }

    public function categoryView() {
        $title = "Task Category";
        $user = Auth::user();
        $categories = TaskCategoryModel::where('user_id', $user->id)->get();
        $account = Account::where('user_id', $user->id)->first();

        return view('Users.category',compact('user', 'account', 'title', 'categories'));
    }

    public function categoryStore(Request $request) {
        $user = Auth::user();

        $validated = $request->validate([
            'categoryName' => 'required|unique:task_categories,category_name',
        ]);

        $taskCategory = TaskCategoryModel::create([
            'category_name' => $validated['categoryName'],
            'user_id' => $user->id,
        ]);

        return redirect()->back()->with('success', "Category Added Successfully!");
    }

    public function filterTask(Request $request) {
        $user = Auth::user();
        $filter = $request->input('filter', 'all');
        $account = Account::where('user_id', $user->id)->first();
        $categories = TaskCategoryModel::where('user_id', $user->id)->get();
        if ($filter == 'done') {
            $title = "Completed Task";
            $tasks = TaskModel::whereHas('progress', function ($query) {
                $query->where('status', 'Completed');
            })->where('user_id', $user->id)->paginate(5);
        } elseif ($filter == 'pending') {
            $title = "Pending Task";
            $tasks = TaskModel::whereHas('progress', function ($query) {
                $query->where('status', 'Pending');
            })->where('user_id', $user->id)->paginate(5);
        } elseif ($filter == 'ongoing') {
            $title = "On Going Task";
            $tasks = TaskModel::whereHas('progress', function ($query) {
                $query->where('status', 'Ongoing');
            })->where('user_id', $user->id)->paginate(5);
        }
         else {
            $title = "My Task";
            $tasks = TaskModel::where('user_id', $user->id)->paginate(5);
        }

        return view('Users.task', compact('title', 'account', 'categories', 'tasks'));
    }

    public function updateProgress(Request $request, $id) {
        $user = Auth::user();

        $validated = Validator::make($request->all(),[
            'progress_percentage' => 'nullable|integer|min:0|max:100',
        ]);

        if($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        $task = TaskModel::where('id', $id)->where('user_id', $user->id)->first();

        if (!$task) {
            return redirect()->back()->with('error', 'Task not found or unauthorized.');
        }

        $task->progress()->updateOrCreate(
            ['task_id' => $task->id],
            [
                'progress_percentage' => $request->progress_percentage ?? 0,
            ]
        );

        $task->touch();

        return redirect()->route('user-task')->with('success', 'Task Progress Updated!');
    }

    public function upcomingTaskPage(Request $request)
    {
        $title = "Upcoming Task";
        $user = Auth::user();
        $account = Account::where('user_id', $user->id)->first();
        $categories = TaskCategoryModel::where('user_id', $user->id)->get();
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();


        $selectedDate = $request->query('date', now()->toDateString());
        $startOfWeek = $today->copy()->startOfWeek();
        $weekDates = collect(range(0, 6))->mapWithKeys(fn ($i) => [
            $startOfWeek->copy()->addDays($i)->format('D') => $startOfWeek->copy()->addDays($i)
        ]);


        $tasks = TaskModel::where('user_id', $user->id)->whereDate('due_date', $selectedDate)->paginate(5);

        return view('Users.upcoming', compact('title', 'user', 'account', 'tasks', 'weekDates', 'categories'));
    }

    public function todayPage() {
        $title = "Today Task";
        $user = Auth::user();
        $account = Account::where('user_id', $user->id)->first();
        $tasks = TaskModel::where('user_id', $user->id)->where('due_date', '=', Carbon::today())->with('progress')->get();


        $groupedTasks = $tasks->groupBy(function ($tasks){
            return $tasks->progress->status;
        });

        $missingTasks = TaskModel::where('due_time', '<', Carbon::now())->where('due_date', '=', Carbon::today())->whereHas('progress', function($query) {
            $query->whereIn('status', ['Pending', 'Ongoing']);
        })->where('user_id', $user->id)->get();

        return view('Users.today', compact('title', 'user', 'account', 'groupedTasks', 'missingTasks'));
    }
}
