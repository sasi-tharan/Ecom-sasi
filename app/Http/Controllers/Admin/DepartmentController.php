<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\DepartmentFormRequest;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean',
        ]);

        $data = [
            'department_title' => $request->input('department_title'),
            'status' => $request->has('status') ? '1' : '0',
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/departments/', $filename);
            $data['image'] = "uploads/departments/$filename";
        }

        Department::create($data);

          // Store a success message in the session
          session()->flash('success', 'Department created successfully');

          return redirect('/admin/departments');


    }

    public function edit(Department $department)
    {

        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'department_title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean',
        ]);

        $data = [
            'department_title' => $request->input('department_title'), // Corrected input name
            'status' => $request->has('status') ? '1' : '0',
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/departments/', $filename);
            $data['image'] = "uploads/departments/$filename";
        }

        $department->update($data);

         // Store a success message in the session
         session()->flash('success', 'Department Updated successfully');

         return redirect('/admin/departments');
    }

    public function destroy(Department $department)
    {
        optional($department, function ($department) {
            // Delete related groups
            $department->groups()->delete();

            $destination = $department->image;

            if (File::exists($destination)) {
                File::delete($destination);
            }

            $department->delete();
        });

        // Store a success message in the session
        return back()->with('success', 'Department Deleted Successfully');
    }




}
