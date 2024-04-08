<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string'], // Validate the role name
        ]);

        $roleName = $request->role;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $roleName, // Store the role name directly
        ]);

        // Store a success message in the session
        session()->flash('success', 'User created successfully');

        return redirect('/admin/users');
    }



    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        $roles = Role::all(); // Assuming you have a Role model and roles table

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, int $userId)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string'], // Validate the role name
        ]);

        // Find the user by ID
        $user = User::findOrFail($userId);

        // Update the user's name and password
        $user->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Update the role name
        ]);

        // Redirect back with a success message
        return redirect('/admin/users')->with('message', 'User updated successfully');
    }


    public function destroy(int $userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect('/admin/users')->with('message','User Deleted successfully');

    }
}
