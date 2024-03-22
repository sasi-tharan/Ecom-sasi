<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SliderFormRequest;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
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
        $file->move('uploads/slider/', $filename);
        $validatedData['image'] = "uploads/slider/$filename";
    }

    $validatedData['status'] = $request->status == true ? '1' : '0';

    Slider::create([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'image' => $validatedData['image'],
        'status' => $validatedData['status'],
    ]);

     // Store a success message in the session
     session()->flash('success', 'Slider Added Successfully');

     return redirect('admin/sliders');
}

    public function edit(Slider $slider)
    {

        return view('admin.slider.edit',compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'status' => 'nullable',
        ]);

        $validatedData = $request->all();

        if ($request->hasFile('image')) {
            $destination = $slider->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/slider/', $filename);
            $validatedData['image'] = "uploads/slider/$filename";
        }

        $validatedData['status'] = $request->status == true ? '1' : '0';

        Slider::where('id', $slider->id)->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'] ?? $slider->image,
            'status' => $validatedData['status'],
        ]);

         // Store a success message in the session
         session()->flash('success', 'Slider Updated Successfully');

         return redirect('admin/sliders');
    }


    public function destroy(Slider $slider)
    {
        if($slider->count() > 0 ){
            $destination = $slider->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $slider->delete();
             // Store a success message in the session
             session()->flash('success', 'Slider Deleted Successfully');

             return redirect('admin/sliders');
        }
        return redirect('admin/sliders')->with('message','Something went wrong');

    }
}
