<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\FeaturedBanner;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class FeaturedBannerController extends Controller
{
    public function index()
    {
        $featured_banners = FeaturedBanner::all();
        return view('admin.featured_banners.index', compact('featured_banners'));
    }

    public function create()
    {
        return view('admin.featured_banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'dimension' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'status' => 'nullable',
        ]);

        $validatedData = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/featured_banner/', $filename);
            $validatedData['image'] = "uploads/featured_banner/$filename";
        }

        $validatedData['status'] = $request->status == true ? '1' : '0';

        // Log the validated data before creating the record
        info('Validated Data:', $validatedData);

        FeaturedBanner::create([
            'title' => $validatedData['title'],
            'dimension' => $validatedData['dimension'],
            'image' => $validatedData['image'],
            'status' => $validatedData['status'],
        ]);

        // Store a success message in the session
        session()->flash('success', 'Featured Banner Added Successfully');

        return redirect('admin/featured_banners');
    }


    public function edit(FeaturedBanner $featured_banner)
    {

        return view('admin.featured_banners.edit',compact('featured_banner'));
    }

    public function update(Request $request, FeaturedBanner $featured_banner)
    {
        $request->validate([
            'title' => 'required|string',
            'dimension' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'status' => 'nullable',
        ]);

        $validatedData = $request->all();

        if ($request->hasFile('image')) {
            $destination = $featured_banner->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/featured_banner/', $filename);
            $validatedData['image'] = "uploads/featured_banner/$filename";
        }

        $validatedData['status'] = $request->status == true ? '1' : '0';

        FeaturedBanner::where('id', $featured_banner->id)->update([
            'title' => $validatedData['title'],
            'dimension' => $validatedData['dimension'],
            'image' => $validatedData['image'] ?? $featured_banner->image,
            'status' => $validatedData['status'],
        ]);

        // Debugging with dd statement
        // dd($validatedData);

        // Store a success message in the session
        session()->flash('success', 'Featured Banner Updated Successfully');

        return redirect('admin/featured_banners');
    }



    public function destroy(FeaturedBanner $featured_banner)
    {
        if($featured_banner->count() > 0 ){
            $destination = $featured_banner->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $featured_banner->delete();
             // Store a success message in the session
             session()->flash('success', 'Featured Banner Deleted Successfully');

             return redirect('admin/featured_banners');
        }
        return redirect('admin/featured_banners')->with('message','Something went wrong');

    }
}
