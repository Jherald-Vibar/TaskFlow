<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function dashboard() {
       $user = Auth::user();
       $account = Account::where('user_id', $user->id)->first();

       if(!$account) {
         return redirect()->route('createForm', ['id' => $user->id])->with('error', 'You need to Create an Account!');
       }
       return view('Users.dashboard', compact('account'));
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
            'image' => $validated['image'],
            'user_id' => $user->id,
        ]);
        return redirect()->route('user-dashboard')->with('success', 'Successfully Created an Account');
    }

}
