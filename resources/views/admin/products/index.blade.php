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
                                <form action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file" class="form-control">
                                    <br>
                                    <button type="submit" class="btn btn-success">Import Product Data</button>
                                </form>
                            </div>
                            <!-- Export Button -->
                            <a href="{{ route('export.products') }}" class="btn btn-success btn-sm text-white me-2">Export</a>
                            <!-- Refresh Button -->
                            <button class="btn btn-info btn-sm text-white me-2" onclick="location.reload()">Refresh</button>
                            <!-- Add Products Button -->
                            <a href="{{ url('admin/products/create') }}" class="btn btn-primary btn-sm text-white me-2">Add Products</a>
                        </div>
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Wrap form elements in a div with appropriate classes -->
                    <form class="ml-2" id="filterForm" method="GET" enctype="multipart/form-data" action="{{ route('admin.products.filter') }}">
                        @csrf
                        <div class="row">
                            <!-- Department Select -->
                            <div class="col-md-2">
                                <input type="text" class="form-control" placeholder="Department" name="department_title" id="department">
                            </div>
                            <!-- Group Select -->
                            <div class="col-md-2">
                                <input type="text" class="form-control" placeholder="Group" name="group_title" id="group">
                            </div>
                            <!-- SI/UPC Input -->
                            <div class="col-md-2">
                                <input type="text" class="form-control" placeholder="SI/UPC" name="si_upc" id="si_upc">
                            </div>
                            <!-- Barcode Input -->
                            <div class="col-md-2">
                                <input type="text" class="form-control" placeholder="Barcode" name="barcode_sku" id="barcode_sku">
                            </div>
                            <!-- Product Name Input -->
                            <div class="col-md-2">
                                <input type="text" class="form-control" placeholder="Product Name" name="product_name" id="product_name">
                            </div>
                            <!-- Apply Filter Button -->
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <table id="productsTable" class="table table-bordered table-striped">
                        <!-- Table Headers (thead) -->
                        <thead>
                            <tr>
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
                        <!-- Table Body (tbody) -->
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->si_upc }}</td>
                                    <td>{{ $product->department_title }}</td>
                                    <td>{{ $product->barcode_sku }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->product_description }}</td>
                                    <td>{{ $product->status ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <!-- Action Buttons -->
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
                                    <td colspan="8">No products found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

    <script>
        $(document).ready(function() {
            // Initialize DataTable on productsTable
            $('#productsTable').DataTable();
        });
    </script>

@endsection
