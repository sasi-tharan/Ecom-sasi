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

                        <div class="">
                            <!-- New form for importing user data -->
                            <div class="d-inline-block">
                                <!-- Wrap form elements in a div with appropriate classes -->
                                <form action="{{ route('admin.products.import') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <input type="file" name="file" class="form-control">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit"
                                                class="btn btn-success btn-sm text-white me-2">Import</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- Export, Refresh, and Add Products Button -->
                                <div class="row align-items-center mt-2">
                                    <div class="col-auto">
                                        <a href="{{ route('export.products') }}"
                                            class="btn btn-success btn-sm text-white me-2">Export</a>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-success btn-sm text-white me-2"
                                            onclick="location.reload()">Refresh</button>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ url('admin/products/create') }}"
                                            class="btn btn-success btn-sm text-white me-2">Add Products</a>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </h4>
                </div>
                <div class="card-body">
                    <style>
                        /* Custom CSS to change input box border color to black */
                        input.form-control.text-dark {
                            border-color: black;
                        }
                    </style>
                    <!-- Wrap form elements in a div with appropriate classes -->
                    <form class="ml-2" id="filterForm" method="GET" enctype="multipart/form-data"
                        action="{{ route('admin.products.filter') }}">
                        @csrf
                        <div class="row">
                            <!-- Department Select -->
                            <div class="col-md-2">
                                <input type="text" class="form-control text-dark" placeholder="Department"
                                    name="department_title" id="department">
                            </div>
                            <!-- Group Select -->
                            <div class="col-md-2">
                                <input type="text" class="form-control text-dark" placeholder="Group" name="group_title"
                                    id="group">
                            </div>
                            <!-- SI/UPC Input -->
                            <div class="col-md-2">
                                <input type="text" class="form-control text-dark" placeholder="SI/UPC" name="si_upc"
                                    id="si_upc">
                            </div>
                            <!-- Barcode Input -->
                            <div class="col-md-2">
                                <input type="text" class="form-control text-dark" placeholder="Barcode"
                                    name="barcode_sku" id="barcode_sku">
                            </div>
                            <!-- Product Name Input -->
                            <div class="col-md-2">
                                <input type="text" class="form-control text-dark" placeholder="Product Name"
                                    name="product_name" id="product_name">
                            </div>
                            <!-- Apply Filter Button -->
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-success btn-sm text-white me-2">Search</button>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="card-body">
                    <table id="productsTable" class="cell-border" style="border-collapse: collapse;">
                        <!-- Table Headers (thead) -->
                        <thead>
                            <tr>
                                <th style="border: 1px solid black;">ID</th>
                                <th style="border: 1px solid black;">SI/UPC</th>
                                <th style="border: 1px solid black;">Department</th>
                                <th style="border: 1px solid black;">Barcode</th>
                                <th style="border: 1px solid black;">Product Name</th>
                                <th style="border: 1px solid black;">Description</th>
                                <th style="border: 1px solid black;">Status</th>
                                <th style="border: 1px solid black;">Action</th>
                            </tr>
                        </thead>
                        <!-- Table Body (tbody) -->
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td style="border: 1px solid black;">{{ $product->id }}</td>
                                    <td style="border: 1px solid black;">{{ $product->si_upc }}</td>
                                    <td style="border: 1px solid black;">{{ $product->department_title }}</td>
                                    <td style="border: 1px solid black;">{{ $product->barcode_sku }}</td>
                                    <td style="border: 1px solid black;">{{ $product->product_name }}</td>
                                    <td style="border: 1px solid black;">{{ $product->product_description }}</td>
                                    <td style="border: 1px solid black;">{{ $product->status ? 'Active' : 'Inactive' }}
                                    </td>
                                    <td style="border: 1px solid black;">
                                        <!-- Action Buttons -->
                                        <div class="btn-group" role="group">
                                            <!-- View Icon -->
                                            {{-- <a href="{{ route('admin.products.show', $product->id) }}" class="text-primary"
                                                title="View">
                                                <i class="mdi mdi-eye mdi-24px"></i>
                                            </a> --}}
                                            <!-- Edit Icon -->
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-success"
                                                title="Edit">
                                                <i class="mdi mdi-pencil mdi-24px"></i>
                                            </a>
                                            <!-- Delete Icon with Confirmation -->
                                            <form action="{{ url('admin/products/' . $product->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#" class="text-danger" title="Delete"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this product?')) { this.parentNode.submit(); }">
                                                    <i class="mdi mdi-delete mdi-24px"></i>
                                                </a>
                                            </form>
                                        </div>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" style="border: 1px solid black;">No products found.</td>
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
