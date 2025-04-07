<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\TaskCategoryModel;
use App\Models\TaskModel;
use App\Models\TaskProgress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function taskPage() {
       $title = "My Task";
       $user = Auth::user();
       $categories = TaskCategoryModel::where('user_id', $user->id)->get();
       $account = Account::where('user_id', $user->id)->first();
       if(!$account) {
         return redirect()->route('createForm', ['id' => $user->id])->with('error', 'You need to Create an Account!');
       }
       $tasks = TaskModel::with('progress')->where('user_id', $user->id)->paginate(5);
       return view('Users.task', compact('account', 'tasks', 'user' , 'title', 'categories'));
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
        return view('Users.account', compact('account', 'user' ,'tasks', 'title', 'completedTask'));
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
}
