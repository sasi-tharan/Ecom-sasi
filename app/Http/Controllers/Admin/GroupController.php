<?php

namespace App\Http\Controllers\Admin;

use App\Models\Group;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::with('department')->get();
        return view('admin.groups.index', compact('groups'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.groups.create', compact('departments'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'group_title' => 'required|string|max:255',
            'status' => 'boolean',
        ]);

        $data = [
            'department_id' => $request->input('department_id'),
            'group_title' => $request->input('group_title'),
            'status' => $request->has('status') ? 1 : 0,
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/groups/', $filename);
            $data['image'] = "uploads/groups/$filename";
        }

        Group::create($data);

        // Store a success message in the session
        session()->flash('success', 'Group created successfully');

        return redirect('/admin/groups');
    }

    public function edit(Group $group)
    {
        $departments = Department::all(); // Fetch departments from your database

        return view('admin.groups.edit', compact('group', 'departments'));
    }

    public function update(Request $request, Group $group)
    {
        // Validate the incoming request using the form request validation rules

        $data = [
            'department_id' => $request->input('department_id'),
            'group_title' => $request->input('group_title'),
            'status' => $request->has('status') ? 1 : 0,
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/groups/', $filename);
            $data['image'] = "uploads/groups/$filename";
        }

        $group->update($data);
        session()->flash('success', 'Group Updated successfully');

        return redirect('admin/groups');
    }

    public function destroy(Group $group)
    {
        if ($group) {
            // Delete related sub groups
            $group->subGroups()->delete();

            $group->delete();

            // Store a success message in the session
            session()->flash('success', 'Group Deleted Successfully');

            return redirect('admin/groups');
        }

        // Store an error message in the session if the group is not found or something goes wrong
        session()->flash('error', 'Group not found or something went wrong');

        return redirect('admin/groups');
    }




}
