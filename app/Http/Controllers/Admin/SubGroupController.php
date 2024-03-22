<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\SubGroup;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SubGroupController extends Controller
{
    public function index()
    {
        $subgroups = SubGroup::with('group')->get();
        return view('admin.subgroups.index', compact('subgroups'));
    }

    public function create()
    {
        $groups = Group::all();
        return view('admin.subgroups.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'sub_group_title' => 'required|string|max:255',
        ]);

        $status = $request->has('status') ? $request->input('status') : 'Inactive'; // Default status if checkbox not checked

        $data = [
            'group_id' => $request->input('group_id'),
            'sub_group_title' => $request->input('sub_group_title'),
            'status' => $status,
        ];

        // Insert the data into the database
        SubGroup::create($data);

        // Store a success message in the session
        session()->flash('success', 'Sub Group created successfully');

        return redirect('/admin/subgroups');
    }


    public function edit(SubGroup $subgroup)
    {
        $groups = Group::all(); // Fetch group from your database

        return view('admin.subgroups.edit', compact('subgroup', 'groups'));
    }

    public function update(Request $request, SubGroup $subgroup)
{
    // Validate the incoming request data
    $request->validate([
        'group_id' => 'required|exists:groups,id',
        'sub_group_title' => 'required|string|max:255',
        'status' => 'nullable|in:Active,Inactive', // Assuming status can only be Active or Inactive
    ]);

    // Update the subgroup with the validated data
    $subgroup->update([
        'group_id' => $request->input('group_id'),
        'sub_group_title' => $request->input('sub_group_title'),
        'status' => $request->has('status') ? $request->input('status') : 'Inactive', // Default to 'Inactive' if status not provided
    ]);

    // Store a success message in the session
    session()->flash('success', 'Sub Group updated successfully');

    // Redirect back to the subgroup list or any other appropriate page
    return redirect('/admin/subgroups');
}


    public function destroy(SubGroup $subgroup)
    {
        if ($subgroup) {
            $subgroup->delete();

            // Store a success message in the session
            session()->flash('success', 'Sub Group Deleted Successfully');

            return redirect('admin/subgroups');
        }

        // Store an error message in the session if the group is not found or something goes wrong
        session()->flash('error', 'SubGroup not found or something went wrong');

        return redirect('admin/subgroups');
    }

}
