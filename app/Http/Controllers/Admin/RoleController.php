<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::all();

        if ($request->wantsJson()) {
            return response()->json(['roles' => $roles], 200);
        }

        return view('admin.roles.index', compact('roles'));
    }

    public function create(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Creating a role is not supported via API.'], 422);
        }

        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
            'role_description' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $role = Role::create([
            'role_name' => $request->input('role_name'),
            'role_description' => $request->input('role_description'),
            'status' => $request->input('status'),
        ]);

        if ($request->wantsJson()) {
            return response()->json(['role' => $role, 'message' => 'Role created successfully'], 201);
        }

        // Store a success message in the session
        session()->flash('success', 'Role created successfully');

        return redirect()->route('admin.roles.index');
    }


    public function edit(Request $request, $roleId)
    {
        $role = Role::findOrFail($roleId);

        if ($request->wantsJson()) {
            return response()->json(['role' => $role], 200);
        }

        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, $roleId)
    {
        $role = Role::findOrFail($roleId);

        $request->validate([
            'role_name' => 'required|string|max:255',
            'role_description' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $role->update([
            'role_name' => $request->input('role_name'),
            'role_description' => $request->input('role_description'),
            'status' => $request->input('status'),
        ]);

        if ($request->wantsJson()) {
            return response()->json(['role' => $role, 'message' => 'Role updated successfully'], 200);
        }

        // Store a success message in the session
        session()->flash('success', 'Role updated successfully');

        return redirect()->route('admin.roles.index');
    }


    private function validateRole(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
            'role_description' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);
    }

    public function destroy(Request $request, $roleId)
    {
        $role = Role::findOrFail($roleId);
        $role->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Role deleted successfully'], 200);
        }

        // Store a success message in the session
        session()->flash('success', 'Role deleted successfully');

        return redirect()->route('admin.roles.index');
    }

}
