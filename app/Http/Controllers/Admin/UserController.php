<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index',compact('users'));

    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'user_type' => ['required', 'in:user,admin,staff'], // Adjust the values based on your enum
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
        ]);

        // Store a success message in the session
        session()->flash('success', 'User created successfully');

        return redirect('/admin/users');
    }


    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        return view('admin.users.edit',compact('user'));

    }

    public function update(Request $request, int $userId)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'user_type' => ['required', 'in:user,admin,staff'], // Adjust the values based on your enum
        ]);

        User::findOrFail($userId)->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
        ]);

        return redirect('/admin/users')->with('message','User Updated successfully');
    }

    public function destroy(int $userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect('/admin/users')->with('message','User Deleted successfully');

    }
}
