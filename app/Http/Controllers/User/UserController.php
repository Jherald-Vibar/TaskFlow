<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\TaskCategoryModel;
use App\Models\TaskModel;
use App\Models\TaskProgress;
use App\Models\User;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function taskPage(Request $request) {
        $title = "My Task";
        $user = Auth::user();
        $categories = TaskCategoryModel::where('user_id', $user->id)->get();
        $account = Account::where('user_id', $user->id)->first();

        if (!$account) {
            return redirect()->route('createForm', ['id' => $user->id])
                             ->with('error', 'You need to Create an Account!');
        }

        $sort = $request->input('sort', 'oldest');
        $filterDate = $request->input('filter_date');
        $priority = $request->input('priority');

        $taskQuery = TaskModel::with('progress')->where('user_id', $user->id);

        if ($filterDate) {
            $taskQuery->whereDate('created_at', $filterDate);
        }

        if ($priority) {
            $taskQuery->where('priority', $priority);
        }

        $tasks = $taskQuery->orderBy('created_at', $sort === 'oldest' ? 'asc' : 'desc')
            ->paginate(5)
            ->appends([
                'sort' => $sort,
                'filter_date' => $filterDate,
                'priority' => $priority,
            ]);

        $notifications = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->orderBy('created_at', 'desc')->get();

        $unreadCount = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->count();

        return view('Users.task', compact('account', 'tasks','user','title', 'categories','sort','filterDate','priority' ,'notifications', 'unreadCount'));
    }

    public function createForm($id) {
        $user = User::find($id);
        return view('Users.create_acc', compact('user'));
    }

    public function storeAccount(Request $request, $id) {
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();


            $file->move(public_path('profile-pic'), $fileName);


            $validated['image'] = $fileName;
        }

        Account::create([
            'username' => $request->username,
            'image' => $validated['image'] ?? null,
            'user_id' => $user->id,
        ]);
        return redirect()->route('user-task')->with('success', 'Successfully Created an Account');
    }

    public function viewAccount() {
        $title = "Account";
        $user = Auth::user();
        $account = Account::where('user_id', $user->id)->first();
        $tasks = TaskModel::where('user_id', $user->id)->get();
        $taskIds = $tasks->pluck('id')->toArray();
        $completedTask = 0;
        if (!empty($taskIds)) {
            $completedTask = TaskProgress::whereIn('task_id', $taskIds)->where('status', 'Completed')->count();
        }

        $notifications = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->orderBy('created_at', 'desc')->get();

        $unreadCount = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->count();


        $missingTask = TaskModel::where('due_time', '<', Carbon::now())->where('due_date', '=', Carbon::today())->whereHas('progress', function($query) {
            $query->whereIn('status', ['Pending', 'Ongoing']);
        })->where('user_id', $user->id)->count();

        return view('Users.account', compact('account', 'user' ,'tasks', 'title', 'completedTask', 'missingTask', 'notifications', 'unreadCount'));

        $missingTasks = TaskModel::where(function ($query) {
            $query->whereDate('due_date', '<', now())
            ->orWhere(function ($subQuery){
                $subQuery->whereDate('due_date', now())->whereTime('due_time', '<', now());
            });
        })->where('user_id', $user->id)->count();

        return view('Users.account', compact('account', 'user' ,'tasks', 'title', 'completedTask', 'missingTask'));
    }

    public function updateAccount(Request $request, $id) {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        $account = Account::where('user_id', $user->id)->first();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profile-pic'), $fileName);
            $validated['image'] = $fileName;
        }

        $account->update([
            'username' => $request->username,
            'image' => $validated['image'] ?? $account->image,
        ]);


        if (!empty($request->password)) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->back()->with('success', 'Account updated successfully.');
    }

    public function updatePassword(Request $request, $id) {
        $user = User::findorFail($id);

        $validator = Validator::make($request->all(), [
            'password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully.');

    }

    public function addPassword(Request $request, $id) {
        $user = User::findorFail($id);

        $validator = Validator::make($request->all(), [
            'new_password' => ['required', 'min:8', 'confirmed'],

        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('success', 'Password Added successfully.');

    }

    public function deleteAccount($id) {
        $user = User::findorFail($id);
        if(!$user) {
            return redirect()->back()->with('error', 'User Id not Found');
        }
        $user->delete();
        return redirect()->route('loginForm')->with('success', 'Account Deleted 😞');
    }


    public function dashboard(Request $request) {
        $filterLabel = "day";
        $user = Auth::user();
        $title = "Dashboard";
        $account = Account::where('user_id', $user->id)->first();
        $filterRange = $request->input('range', 'today');
        $tasks = TaskModel::with('progress')->whereHas('progress')->where('user_id', $user->id)->get();

        $taskss = TaskModel::with('progress')->whereHas('progress')->where('user_id', $user->id)->paginate(5);
        $totalTask = $tasks->count();

        $tasksInWeek = $tasks->filter(function ($task) {
            return \Carbon\Carbon::parse($task->created_at)->isToday() || \Carbon\Carbon::parse($task->created_at)->isCurrentWeek();
        })->count();

        $tasksInMonth = $tasks->filter(function ($task) {
            return \Carbon\Carbon::parse($task->created_at)->isToday() || \Carbon\Carbon::parse($task->created_at)->isCurrentMonth();
        })->count();

        $tasksIn60Days = $tasks->filter(function ($task){
            return \Carbon\Carbon::parse($task->created_at)->gt(now()->subDays(60));
        })->count();

        $tasksIn90Days = $tasks->filter(function ($task){
            return \Carbon\Carbon::parse($task->created_at)->gt(now()->subDays(90));
        })->count();

        $groupedTasks = [
            'Completed' => $tasks->filter(fn ($task) => $task->progress && $task->progress->status === 'Completed')->count(),
            'Ongoing' => $tasks->filter(fn ($task) => $task->progress && $task->progress->status === 'Ongoing')->count(),
            'Pending' => $tasks->filter(fn ($task) => $task->progress && $task->progress->status === 'Pending')->count(),
            'Total' => $totalTask,
        ];

        $tasksProgress = [
            'Mon' => $tasks->filter(fn ($task) =>
                $task->progress && $task->progress->status === 'Completed' &&
                Carbon::parse($task->created_at)->isMonday() &&
                Carbon::parse($task->created_at)->isCurrentWeek()
            )->count(),

            'Tue' => $tasks->filter(fn ($task) =>
                $task->progress && $task->progress->status === 'Completed' &&
                Carbon::parse($task->created_at)->isTuesday() &&
                Carbon::parse($task->created_at)->isCurrentWeek()
            )->count(),

            'Wed' => $tasks->filter(fn ($task) =>
                $task->progress && $task->progress->status === 'Completed' &&
                Carbon::parse($task->created_at)->isWednesday() &&
                Carbon::parse($task->created_at)->isCurrentWeek()
            )->count(),

            'Thurs' => $tasks->filter(fn ($task) =>
                $task->progress && $task->progress->status === 'Completed' &&
                Carbon::parse($task->created_at)->isThursday() &&
                Carbon::parse($task->created_at)->isCurrentWeek()
            )->count(),

            'Fri' => $tasks->filter(fn ($task) =>
                $task->progress && $task->progress->status === 'Completed' &&
                Carbon::parse($task->created_at)->isFriday() &&
                Carbon::parse($task->created_at)->isCurrentWeek()
            )->count(),

            'Sat' => $tasks->filter(fn ($task) =>
                $task->progress && $task->progress->status === 'Completed' &&
                Carbon::parse($task->created_at)->isSaturday() &&
                Carbon::parse($task->created_at)->isCurrentWeek()
            )->count(),

            'Sun' => $tasks->filter(fn ($task) =>
                $task->progress && $task->progress->status === 'Completed' &&
                Carbon::parse($task->created_at)->isSunday() &&
                Carbon::parse($task->created_at)->isCurrentWeek()
            )->count(),
        ];

        $taskFiltered = '';

        if($filterRange == 'today') {
            $filterLabel = "day";
            $taskFiltered = $tasks->filter(function ($task) {
                return Carbon::parse($task->created_at)->today() &&
                Carbon::parse($task->created_at)->isCurrentWeek();
            })->count();
        }
        elseif($filterRange == 'yesterday') {
            $filterLabel = "yesterday";
            $taskFiltered = $tasks->filter(function ($task) {
                return Carbon::parse($task->created_at)->isYesterday() &&
                Carbon::parse($task->created_at)->isCurrentWeek();
            })->count();
        }
        elseif($filterRange == '7days') {
            $filterLabel = "week";
            $taskFiltered = $tasksInWeek;
        } elseif($filterRange == '30days') {
            $filterLabel = "30 Days";
            $taskFiltered = $tasksInMonth;
        } elseif($filterRange == '60days') {
            $filterLabel = "60 Days";
            $taskFiltered = $tasksIn60Days;
        } elseif($filterRange == '90days') {
            $filterLabel = "90 Days";
            $taskFiltered = $tasksIn90Days;
        }


        $lastWeekTask = $tasks->filter(function ($task) {
            return \Carbon\Carbon::parse($task->created_at)->isLastWeek();
        })->count();


        if($lastWeekTask > 0) {
            $changePercent = (($tasksInWeek - $lastWeekTask) / $lastWeekTask) * 100;
        } else {
            $changePercent = $tasksInWeek > 0 ? 100 : 0;
        }

        $notifications = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->orderBy('created_at', 'desc')->get();

        $unreadCount = Notification::where('user_id', $user->id)->where('status', 0)->whereHas('task')->count();


        return view('Users.dashboard', compact('user', 'account' , 'title', 'tasks', 'taskss', 'groupedTasks', 'tasksProgress', 'taskFiltered', 'filterLabel', 'changePercent', 'notifications', 'unreadCount'));
    }

}
