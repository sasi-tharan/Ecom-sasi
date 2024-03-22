<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
use App\Models\Department;
use App\Models\Group;
use App\Models\Product;
use App\Models\SubGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve all products from the database with eager loading of departments and product images
        $products = Product::with('department', 'productImages')->get();

        // Pass the products to the view
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $departments = Department::all();
        $groups = Group::all();
        $subGroups = SubGroup::all();
        $products = Product::all(); // Fetch all products

        return view('admin.products.create', compact('departments', 'groups', 'subGroups', 'products'));
    }

    public function store(Request $request)
    {
        // Create a new product with the validated data
        $product = Product::create([
            'department_id' => $request->department_id,
            'group_id' => $request->group_id,
            'sub_group_id' => $request->sub_group_id,
            'department_title' => $request->department_title,
            'group_title' => $request->group_title,
            'sub_group_title' => $request->sub_group_title,
            'si_upc' => $request->si_upc,
            'barcode_sku' => $request->barcode_sku,
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'packsize' => $request->packsize,
            'unit_price' => $request->unit_price,
            'case_price' => $request->case_price,
            'rsp' => $request->rsp,
            'vat' => $request->vat,
            'por' => $request->por,
            'bcqty_1' => $request->bcqty_1,
            'bcp_1' => $request->bcp_1,
            'por_1' => $request->por_1,
            'bcqty_2' => $request->bcqty_2,
            'bcp_2' => $request->bcp_2,
            'por_2' => $request->por_2,
            'bcqty_3' => $request->bcqty_3,
            'bcp_3' => $request->bcp_3,
            'por_3' => $request->por_3,
            'status' => $request->status,
            'trending' => $request->trending == true ? '1' : '0',
            'featured' => $request->featured == true ? '1' : '0',
        ]);

        // // Handle product thumbnails upload
        // if ($request->hasFile('image')) {
        //     foreach ($request->file('image') as $image) {
        //         // Generate a unique filename for the image
        //         $filename = uniqid() . '.' . $image->getClientOriginalExtension();

        //         // Store the image with the generated filename
        //         $path = $image->storeAs('uploads/product_thumbnail', $filename);

        //         // Create an entry in the database with the image path
        //         $product->productThumbnails()->create(['image' => $path]);
        //     }
        // }

        // Handle large image upload
        if ($request->hasFile('large_image')) {
            $file = $request->file('large_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/product_large/', $filename);
            $product->productImages()->create(['large_image' => "uploads/product_large/$filename"]);
        }

        // Store a success message in the session
        session()->flash('success', 'Product created successfully');

        return redirect('/admin/products');
    }

    public function edit(Product $product)
    {
        $departments = Department::all(); // Assuming you have a Department model
        $groups = Group::all(); // Assuming you have a Group model
        $subGroups = SubGroup::all(); // Assuming you have a SubGroup model

        return view('admin.products.edit', compact('product', 'departments', 'groups', 'subGroups'));
    }

    public function update(Request $request, Product $product)
    {
        // Validate the incoming request data
        $request->validate([
            // Add your validation rules here
        ]);

        // Update the product with the validated data
        $product->update([
            'department_id' => $request->department_id,
            'group_id' => $request->group_id,
            'sub_group_id' => $request->sub_group_id,
            'department_title' => $request->department_title,
            'group_title' => $request->group_title,
            'sub_group_title' => $request->sub_group_title,
            'si_upc' => $request->si_upc,
            'barcode_sku' => $request->barcode_sku,
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'packsize' => $request->packsize,
            'unit_price' => $request->unit_price,
            'case_price' => $request->case_price,
            'rsp' => $request->rsp,
            'vat' => $request->vat,
            'por' => $request->por,
            'bcqty_1' => $request->bcqty_1,
            'bcp_1' => $request->bcp_1,
            'por_1' => $request->por_1,
            'bcqty_2' => $request->bcqty_2,
            'bcp_2' => $request->bcp_2,
            'por_2' => $request->por_2,
            'bcqty_3' => $request->bcqty_3,
            'bcp_3' => $request->bcp_3,
            'por_3' => $request->por_3,
            'status' => $request->status,
            'trending' => $request->trending == true ? '1' : '0',
            'featured' => $request->featured == true ? '1' : '0',
        ]);

        // Handle large image upload if a new image is provided
        if ($request->hasFile('large_image')) {
            // Delete the existing large image if it exists
            if ($product->productImages()->exists()) {
                // Assuming one product can have only one large image, you might need to adjust this logic if that's not the case
                $product->productImages()->delete();
            }

            // Upload the new large image
            $file = $request->file('large_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/product_large/', $filename);
            $product->productImages()->create(['large_image' => "uploads/product_large/$filename"]);
        }

        // Store a success message in the session
        session()->flash('success', 'Product updated successfully');

        return redirect('/admin/products');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        try {
            // Import Excel file data using Maatwebsite Excel
            Excel::import(new ProductImport, $file);

            // Log a success message
            Log::info('Product data imported successfully');

            return redirect('/admin/products')->with('success', 'Product data imported successfully');
        } catch (\Throwable $e) {
            // Log any exceptions that occur during the import process
            Log::error('Error importing product data: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred during the import process');
        }
    }

    public function export()
    {
        return Excel::download(new ProductExport(), 'products.xlsx');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function delete(Product $product)
    {
        // Delete the product
        $product->delete();

        // Optionally, you can also delete associated images or related data here

        // Store a success message in the session
        session()->flash('success', 'Product deleted successfully');

        // Redirect back to the product index page
        return redirect('/admin/products');
    }

}
