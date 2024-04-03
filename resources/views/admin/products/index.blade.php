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
                            <!-- New form for importing user data -->
                            <div class="d-inline-block">
                                <!-- Wrap form elements in a div with appropriate classes -->
                                <form action="{{ route('admin.products.import') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file" class="form-control">
                                    <br>
                                    <button type="submit" class="btn btn-success">Import Product Data</button>
                                </form>
                            </div>
                            <!-- Export Button -->
                            <a href="{{ route('export.products') }}" class="btn btn-success btn-sm text-white me-2">
                                Export
                            </a>
                            <!-- Refresh Button -->
                            <button class="btn btn-info btn-sm text-white me-2" onclick="location.reload()">
                                Refresh
                            </button>
                            <!-- Add Products Button -->
                            <a href="{{ url('admin/products/create') }}" class="btn btn-primary btn-sm text-white me-2">
                                Add Products
                            </a>
                        </div>
                    </h4>
                    <!-- Filter options -->
                    <form id="filterForm" method="GET" action="{{ route('admin.products.filter') }}">
                        <div class="row mt-3">
                            <!-- Department Select -->
                            <div class="col-md-2">
                                <input type="text" class="form-control" placeholder="Department" name="department"
                                    id="department">
                            </div>
                            <!-- Group Select -->
                            <div class="col-md-2">
                                <input type="text" class="form-control" placeholder="Group" name="group"
                                    id="group">
                            </div>
                            <!-- SI/UPC Input -->
                            <div class="col-md-2">
                                <input type="text" class="form-control" placeholder="SI/UPC" name="si_upc"
                                    id="si_upc">
                            </div>
                            <!-- Barcode Input -->
                            <div class="col-md-2">
                                <input type="text" class="form-control" placeholder="Barcode" name="barcode_sku"
                                    id="barcode_sku">
                            </div>
                            <!-- Product Name Input -->
                            <div class="col-md-2">
                                <input type="text" class="form-control" placeholder="Product Name" name="product_name"
                                    id="product_name">
                            </div>
                            <!-- Trending Checkbox -->
                            <!-- Add your other form fields here -->

                            <!-- Apply Filter Button -->
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Apply Filter</button>
                            </div>
                        </div>
                    </form>
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
                                    <td><input type="checkbox" class="productCheckbox" name="selected_products[]"
                                            value="{{ $product->id }}"></td> <!-- Checkbox for product selection -->
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->si_upc }}</td>
                                    <td>{{ $product->department_title }}</td> <!-- Display department title -->
                                    <td>{{ $product->barcode_sku }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->product_description }}</td>
                                    <td>{{ $product->status ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <!-- View Icon -->
                                        <a href="{{ route('admin.products.show', $product->id) }}" class="text-primary"
                                            title="View">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                        <!-- Edit Icon -->
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-success"
                                            title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <!-- Delete Icon with Confirmation -->
                                        <form action="{{ url('admin/products/' . $product->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this product?')">
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
        $(document).ready(function() {
            // Add event listener to the "select all" checkbox
            $('#selectAllCheckbox').change(function() {
                // Get all checkboxes in the table body
                var checkboxes = $('tbody input[type="checkbox"]');
                // Set the checked property of each checkbox to match the "select all" checkbox
                checkboxes.prop('checked', $(this).prop('checked'));
            });

        });
    </script>

        <script>
            $(document).ready(function() {
                // Initialize DataTable on productsTable
                $('#productsTable').DataTable();
            });
        </script>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            // Function to handle autocomplete for product name
            $('#product_name').keyup(function() {
                var query = $(this).val();
                if (query != '') {
                    $.ajax({
                        url: "{{ route('admin.products.autocomplete') }}",
                        method: 'GET',
                        data: {query: query},
                        success: function(data) {
                            var productsTableBody = $('#productsTable tbody');
                            productsTableBody.empty(); // Clear previous table rows
                            if (data.length > 0) {
                                $.each(data, function(index, product) {
                                    var row = $('<tr>');
                                    row.append($('<td>').text(product.id)); // Product ID
                                    row.append($('<td>').text(product.si_upc)); // SI/UPC
                                    row.append($('<td>').text(product.department_title)); // Department
                                    row.append($('<td>').text(product.barcode_sku)); // Barcode
                                    row.append($('<td>').text(product.product_name)); // Product Name
                                    row.append($('<td>').text(product.product_description)); // Description
                                    row.append($('<td>').text(product.status ? 'Active' : 'Inactive')); // Status
                                    productsTableBody.append(row); // Append the row to the table body
                                });
                            } else {
                                var row = $('<tr>').append($('<td colspan="7">').text('No products found.'));
                                productsTableBody.append(row); // Append the "No products found" message
                            }
                        }
                    });
                }
            });
        });
    </script> --}}

@endpush
