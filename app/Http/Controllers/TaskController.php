<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Notification;
use App\Models\TaskCategoryModel;
use App\Models\TaskModel;
use App\Models\TaskProgress;
use App\Rules\TimeFormat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Spatie\Activitylog\Models\Activity;

class TaskController extends Controller
{
    public function taskStore(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'taskName'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'required|date',
            'due_time'    => ['nullable', new TimeFormat],
            'priority'    => 'required|in:Low,Medium,High',
            'category_id' => 'nullable|exists:task_categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dueTime = $request->due_time
            ? \Carbon\Carbon::createFromFormat('H:i', $request->due_time)->format('H:i:s')
            : null;

        $task = TaskModel::create([
            'task_name'   => $request->taskName,
            'description' => $request->description,
            'due_date'    => $request->due_date,
            'due_time'    => $dueTime,
            'priority'    => $request->priority,
            'user_id'     => $user->id,
            'category_id' => $request->category_id,
        ]);

        TaskProgress::create([
            'task_id'             => $task->id,
            'progress_percentage' => 0,
            'status'              => 'Pending',
        ]);

        $messages = "New Task Created: ";

        Notification::create([
            'user_id' => $user->id,
            'task_id' => $task->id,
            'messages' => $messages . $task->task_name,
        ]);

        $notif = Notification::where('user_id', $user->id)->whereHas('task')->where('task_id', $task->id)->get();

        Mail::send('emails.task-email', ['notif' => $notif, 'user' => $user], function ($message) use ($user) {
        $message->to($user->email)
            ->subject('📝 New Task Created');
        });

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
        $user = Auth::user();
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

        $notifications = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->orderBy('created_at', 'desc')->get();

        $unreadCount = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->count();

        return view('Users.task', compact('tasks', 'account', 'title', 'categories', 'notifications', 'unreadCount'));
    }

    public function categoryView() {
        $title = "Task Category";
        $user = Auth::user();
        $categories = TaskCategoryModel::where('user_id', $user->id)->get();
        $account = Account::where('user_id', $user->id)->first();
        $tasks = TaskModel::where('user_id', $user->id)->whereHas('progress')->get();

        $notifications = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->orderBy('created_at', 'desc')->get();

        $unreadCount = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->count();

        return view('Users.category',compact('user', 'account', 'title', 'categories', 'tasks', 'notifications', 'unreadCount'));
    }

    public function singleCategoryView($id) {
        $title = "Category Details";
        $user = Auth::user();

        $category = TaskCategoryModel::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $account = Account::where('user_id', $user->id)->first();

        $tasks = TaskModel::where('user_id', $user->id)
            ->where('category_id', $id)
            ->whereHas('progress')
            ->get();

        $notifications = Notification::where('user_id', $user->id)
            ->where('status', 0)
            ->whereHas('task')
            ->orderBy('created_at', 'desc')
            ->get();

        $unreadCount = Notification::where('user_id', $user->id)
            ->where('status', 0)
            ->whereHas('task')
            ->count();

        return view('Users.single_category', compact(
            'user',
            'account',
            'title',
            'category',
            'tasks',
            'notifications',
            'unreadCount'
        ));
    }

    public function categoryStore(Request $request) {
        $user = Auth::user();

        $validated = $request->validate([
            'categoryName' => 'required|unique:task_categories,category_name,NULL,id,user_id,'.$user->id,
        ]);

        $taskCategory = TaskCategoryModel::create([
            'category_name' => $validated['categoryName'],
            'user_id' => $user->id,
        ]);

        if (!$taskCategory) {
            return redirect()->back()->with('error', "Failed to create category");
        }

        $categories = TaskCategoryModel::where('user_id', $user->id)->get();

        return redirect()->back()->with('success', "Category Added Successfully!")->with('categories', $categories);
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
            $title = "Task List";
            $tasks = TaskModel::where('user_id', $user->id)->paginate(5);
        }

        $notifications = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->orderBy('created_at', 'desc')->get();

        $unreadCount = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->count();

        return view('Users.task', compact('title', 'account', 'categories', 'tasks', 'notifications', 'unreadCount'));
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

     public function reorderTasks(Request $request)
    {
        $taskId = $request->input('draggedId');
        $status = $request->input('newStatus');

        if ($status == "Pending") {
            $progress = 0;
        } elseif ($status == "Ongoing") {
            $progress = 50;
        } elseif ($status == "Completed") {
            $progress = 100;
        } else {
            return response()->json(['error' => 'Invalid status'], 400);
        }

        $task = TaskProgress::where('task_id', $taskId)->latest()->first();
        if ($task) {
            $task->progress_percentage = $progress;
            $task->save();
        }

       return response()->json([
            'success' => true,
            'progress_percentage' => $progress,
            'status' => $status,
        ]);
        }


    public function upcomingTaskPage(Request $request)
    {
        $title = "Upcoming Task";
        $user = Auth::user();
        $account = Account::where('user_id', $user->id)->first();
        $categories = TaskCategoryModel::where('user_id', $user->id)->get();
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();

        $missingTasks = TaskModel::where(function($query) {
            $query->whereDate('due_date', '<', now())
                  ->orWhere(function($subQuery) {
                      $subQuery->whereDate('due_date', now())
                               ->whereTime('due_time', '<', Carbon::now());
                  });
        })
        ->whereHas('progress', function($query) {
            $query->whereIn('status', ['Pending', 'Ongoing']);
        })
        ->where('user_id', $user->id)
        ->get();

        $notifications = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->orderBy('created_at', 'desc')->get();

        $unreadCount = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->count();

        $selectedDate = $request->query('date', now()->toDateString());
        $startOfWeek = $today->copy()->startOfWeek();
        $weekDates = collect(range(0, 6))->mapWithKeys(fn ($i) => [
            $startOfWeek->copy()->addDays($i)->format('D') => $startOfWeek->copy()->addDays($i)
        ]);


        $tasks = TaskModel::where('user_id', $user->id)->whereDate('due_date', $selectedDate)->paginate(5);

        return view('Users.upcoming', compact('title', 'user', 'account', 'tasks', 'weekDates', 'categories', 'missingTasks', 'notifications', 'unreadCount'));
    }

    public function todayPage() {
        $title = "Daily Tasks";
        $user = Auth::user();
        $account = Account::where('user_id', $user->id)->first();
        $tasks = TaskModel::where('user_id', $user->id)->where('due_date', '=', Carbon::today())->with('progress')->get();


        $groupedTasks = $tasks->groupBy(function ($tasks){
            return $tasks->progress->status;
        });

        $missingTasks = TaskModel::where('due_time', '<', Carbon::now())->where('due_date', '=', Carbon::today())->whereHas('progress', function($query) {
            $query->whereIn('status', ['Pending', 'Ongoing']);
        })->where('user_id', $user->id)->get();

        $notifications = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->orderBy('created_at', 'desc')->get();

        $unreadCount = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->count();

        $response = Http::get('https://zenquotes.io/api/today');

        if ($response->successful()) {
            $quote = $response->json()[0];

            $quoteText =  $quote['q'];
            $author = $quote['a'];
        }

        return view('Users.today', compact('title', 'user', 'account', 'groupedTasks', 'missingTasks', 'tasks', 'notifications', 'unreadCount', 'quoteText', 'author'));
    }

    public function markAsRead()
    {
        $userId = Auth::user()->id;
        Notification::where('status', 0)->where('user_id', $userId)->update(['status' => 1]);

        return redirect()->route('user-task')->with('message', 'All notifications marked as read');
    }

    public function markSingleRead($id) {
        $notification = Notification::where('notification_id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 0)
            ->firstOrFail();

        $notification->update(['status' => 1]);

        return redirect()->route('user-task')->with('success', 'Notification Read');
    }

    public function insightIndex() {
    $user = Auth::user();
    $title = "Task Insight";

    $account = Account::where('user_id', $user->id)->first();

    $notifications = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->orderBy('created_at', 'desc')->get();

    $unreadCount = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->count();


    $totalTasks = TaskModel::where('user_id', $user->id)->count();
    $completedTasks = TaskModel::where('user_id', $user->id)
        ->whereNotNull('completed_at')->count();

    $completionRate = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100, 2) : 0;

    $mostProductiveHour = TaskModel::where('user_id', $user->id)
        ->whereNotNull('completed_at')
        ->get()
        ->groupBy(fn($task) => Carbon::parse($task->completed_at)->format('H'))
        ->map->count()
        ->sortDesc()
        ->keys()
        ->first();

    $overdueTasks = TaskModel::where('user_id', $user->id)
        ->whereDate('due_date', '<', now())
        ->whereDoesntHave('progress', fn($q) => $q->where('status', 'Completed'))
        ->count();

    $days = TaskModel::where('user_id', $user->id)
        ->whereNotNull('completed_at')
        ->orderBy('completed_at', 'desc')
        ->pluck('completed_at')
        ->map(fn($date) => Carbon::parse($date)->toDateString())
        ->unique()
        ->values();

    $streak = 0;
    foreach ($days as $i => $day) {
        if ($day == now()->subDays($i)->toDateString()) {
            $streak++;
        } else {
            break;
        }
    }

    return view('Users.insight', compact(
        'completionRate',
        'mostProductiveHour',
        'overdueTasks',
        'streak',
        'title',
        'unreadCount',
        'notifications',
        'account'
    ));
    }

    public function downloadPdf() {

        $user = Auth::user();
    $title = "Task Insight";

    $account = Account::where('user_id', $user->id)->first();

    $notifications = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->orderBy('created_at', 'desc')->get();

    $unreadCount = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->count();


    $totalTasks = TaskModel::where('user_id', $user->id)->count();
    $completedTasks = TaskModel::where('user_id', $user->id)
        ->whereNotNull('completed_at')->count();

    $completionRate = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100, 2) : 0;

    $mostProductiveHour = TaskModel::where('user_id', $user->id)
        ->whereNotNull('completed_at')
        ->get()
        ->groupBy(fn($task) => Carbon::parse($task->completed_at)->format('H'))
        ->map->count()
        ->sortDesc()
        ->keys()
        ->first();

    $overdueTasks = TaskModel::where('user_id', $user->id)
        ->whereDate('due_date', '<', now())
        ->whereDoesntHave('progress', fn($q) => $q->where('status', 'Completed'))
        ->count();

    $days = TaskModel::where('user_id', $user->id)
        ->whereNotNull('completed_at')
        ->orderBy('completed_at', 'desc')
        ->pluck('completed_at')
        ->map(fn($date) => Carbon::parse($date)->toDateString())
        ->unique()
        ->values();

    $streak = 0;
    foreach ($days as $i => $day) {
        if ($day == now()->subDays($i)->toDateString()) {
            $streak++;
        } else {
            break;
        }
    }

        $data = [
        'completionRate' => $completionRate,
        'mostProductiveHour' => $mostProductiveHour,
        'overdueTasks' => $overdueTasks,
        'streak' => $streak,
        ];


    $pdf = PDF::loadView('users.insight_pdf', $data);

    return $pdf->download('productivity-insights-report.pdf');
    }

    public function showActivityLog() {
        $user = Auth::user();
        $account = Account::where('user_id', $user->id)->first();
        $title = "Activity Log";

        $notifications = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->orderBy('created_at', 'desc')->get();

        $unreadCount = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->count();

        $activities = Activity::where('causer_id', $user->id)->latest()->get();
        return view('users.activity_log', compact('activities', 'account', 'title', 'unreadCount', 'notifications', 'user'));
    }

}
