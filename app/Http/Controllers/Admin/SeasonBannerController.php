<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeasonalBanner;
use Illuminate\Http\Request;

class SeasonBannerController extends Controller
{
    public function index()
    {
        $seasonalBanners = SeasonalBanner::all();
        return view('admin.seasonal_banners.index', compact('seasonalBanners'));
    }

    public function create()
    {
        return view('admin.seasonal_banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/seasonal_banners/', $filename);
            $data['image'] = "uploads/seasonal_banners/$filename";
        } else {
            // Handle case where no image is provided
            // You may set a default image path or any other desired behavior
            $data['image'] = ''; // Set a default value or leave it empty depending on your logic
        }
        $data['dimension'] = $request->input('dimension');
        $data['offers'] = $request->input('offers'); // Assuming 'offers' is stored in the database
        // dd($data['offers']);
        $data['status'] = $request->has('status') ? '1' : '0';

        SeasonalBanner::create($data);

        // Store a success message in the session
        session()->flash('success', 'Offer created successfully');

        return redirect('/admin/seasonal_banners');
    }


    public function edit(SeasonalBanner $seasonal_banner)
    {
        return view('admin.seasonal_banners.edit', compact('seasonal_banner'));
    }

    public function update(Request $request, SeasonalBanner $seasonal_banner)
    {

        $data = [
            'offers' => $request->input('offers'), // Corrected input name
            'dimension' => $request->input('dimension'), // Corrected input name
            'status' => $request->has('status') ? '1' : '0',
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/seasonal_banners/', $filename);
            $data['image'] = "uploads/seasonal_banners/$filename";
        }

        $seasonal_banner->update($data);

         // Store a success message in the session
         session()->flash('success', 'Offer Updated successfully');

         return redirect('/admin/seasonal_banners');
    }


    public function destroy(SeasonalBanner $seasonal_banner)
    {
        // Delete the seasonal banner from the database
        $seasonal_banner->delete();

        // Redirect back with success message
        return redirect()->route('admin.seasonal_banners.index')->with('success', 'Seasonal banner deleted successfully.');
    }
}
