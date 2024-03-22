<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'status' => 'nullable',
        ]);

        $validatedData = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/banner/', $filename);
            $validatedData['image'] = "uploads/banner/$filename";
        }

        $validatedData['status'] = $request->status == true ? '1' : '0';

        // Log the validated data before creating the record
        info('Validated Data:', $validatedData);

        Banner::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'status' => $validatedData['status'],
        ]);

        // Store a success message in the session
        session()->flash('success', 'Banner Added Successfully');

        return redirect('admin/banners');
    }


    public function edit(Banner $banner)
    {

        return view('admin.banner.edit',compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'status' => 'nullable',
        ]);

        $validatedData = $request->all();

        if ($request->hasFile('image')) {
            $destination = $banner->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/banner/', $filename);
            $validatedData['image'] = "uploads/banner/$filename";
        }

        $validatedData['status'] = $request->status == true ? '1' : '0';

        Banner::where('id', $banner->id)->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'] ?? $banner->image,
            'status' => $validatedData['status'],
        ]);

         // Store a success message in the session
         session()->flash('success', 'Banner Updated Successfully');

         return redirect('admin/banners');
    }


    public function destroy(Banner $banner)
    {
        if($banner->count() > 0 ){
            $destination = $banner->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $banner->delete();
             // Store a success message in the session
             session()->flash('success', 'Banner Deleted Successfully');

             return redirect('admin/banners');
        }
        return redirect('admin/banners')->with('message','Something went wrong');

    }
}
