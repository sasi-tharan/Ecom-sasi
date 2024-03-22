@extends('layouts.admin')

@section('title', 'Products List')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('success'))
                @section('alertify-script')
                    <script>
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success("{{ session('success') }}");
                    </script>
                @show
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>
                        Products
                        <div class="float-end">
                            <a href="{{ url('admin/products/create') }}" class="btn btn-primary btn-sm text-white me-2">
                                Add Products
                            </a>
                            <button class="btn btn-info btn-sm text-white me-2" onclick="location.reload()">
                                Refresh
                            </button>
                            <a href="{{ route('export.products') }}" class="btn btn-success btn-sm text-white me-2">
                                Export
                            </a>

                            <!-- New form for importing user data -->
                            <div class="d-inline-block">
                                <!-- Wrap form elements in a div with appropriate classes -->
                                <form action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file" class="form-control">
                                    <br>
                                    <button type="submit" class="btn btn-success">Import Product Data</button>
                                </form>
                            </div>

                        </div>
                    </h4>
                </div>


                <div class="card-body">
                    <table id="productsTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="selectAllCheckbox">
                                </th> <!-- Checkbox for selecting all -->
                                <th>ID</th>
                                <th>SI/UPC</th>
                                <th>Department</th>
                                <th>Barcode</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td><input type="checkbox" class="productCheckbox" name="selected_products[]" value="{{ $product->id }}"></td> <!-- Checkbox for product selection -->
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->si_upc }}</td>
                                    <td>{{ $product->department_title }}</td> <!-- Display department title -->
                                    <td>{{ $product->barcode_sku }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->product_description }}</td>
                                    <td>{{ $product->status ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <!-- View Icon -->
                                        <a href="{{ route('admin.products.show', $product->id) }}" class="text-primary" title="View">
                                            <i class="mdi mdi-eye"></i>
                                        </a>

                                        <!-- Edit Icon -->
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-success" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                        <!-- Delete Icon with Confirmation -->
                                        <form action="{{ url('admin/products/' . $product->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this product?')">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No products found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listener to the "select all" checkbox
        var selectAllCheckbox = document.getElementById('selectAllCheckbox');
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                // Get all checkboxes in the table body
                var checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
                // Set the checked property of each checkbox to match the "select all" checkbox
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });
        }
    });
</script>

@endpush
