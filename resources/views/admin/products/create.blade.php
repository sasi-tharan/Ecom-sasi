@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>
                        Add Product
                        <a href="{{ url('admin/products') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                    </h4>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="">SI / UPC</label>
                                <input type="text" name="si_upc" class="form-control" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Barcode / SKU</label>
                                <input type="text" name="barcode_sku" class="form-control" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Product Name</label>
                                <input type="text" name="product_name" class="form-control" />
                            </div>
                            <div class="col-md-8 mb-3">
                                <label for="">Product Description</label>
                                <textarea name="product_description" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="department_id">Department</label>
                                <select name="department_id" id="department_id" class="form-control">
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" data-title="{{ $department->department_title }}">{{ $department->department_title }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="department_title" id="department_title">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="group_id">Group</label>
                                <select name="group_id" id="group_id" class="form-control">
                                    <option value="">Select Group</option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}" data-title="{{ $group->group_title }}">{{ $group->group_title }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="group_title" id="group_title">
                            </div>


                            <div class="col-md-4 mb-3">
                                <label for="sub_group_id">Sub Group 1</label>
                                <select name="sub_group_id" id="sub_group_id" class="form-control">
                                    <option value="">Select Sub Group</option>
                                    @foreach ($subGroups as $subGroup)
                                        <option value="{{ $subGroup->id }}" data-title="{{ $subGroup->sub_group_title }}">{{ $subGroup->sub_group_title }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="sub_group_title" id="sub_group_title">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Pack Size</label>
                                <input type="text" name="packsize" class="form-control" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Unit Price</label>
                                <input type="text" name="unit_price" class="form-control" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Case Price </label>
                                <input type="text" name="case_price" class="form-control" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">RSP</label>
                                <input type="text" name="rsp" class="form-control" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">VAT</label>
                                <input type="text" name="vat" class="form-control" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">POR</label>
                                <input type="text" name="por" class="form-control" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">1 BCQTY</label>
                                <input type="text" name="bcqty_1" class="form-control" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">1 BCP</label>
                                <input type="text" name="bcp_1" class="form-control" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">POR1</label>
                                <input type="text" name="por_1" class="form-control" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">2 BCQTY</label>
                                <input type="text" name="bcqty_2" class="form-control" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">2 BCP</label>
                                <input type="text" name="bcp_2" class="form-control" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">POR 2</label>
                                <input type="text" name="por_2" class="form-control" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">3 BCQTY</label>
                                <input type="text" name="bcqty_3" class="form-control" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">3 BCP</label>
                                <input type="text" name="bcp_3" class="form-control" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">POR 3</label>
                                <input type="text" name="por_3" class="form-control" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">New Arrivals</label>
                                <input type="checkbox" name="new_arrivals" >
                            </div>
                            <div class="col-md-4 mb-3">
                                    <label for="">Trending</label>
                                    <input type="checkbox" name="trending" >
                            </div>
                            <div class="col-md-4 mb-3">
                                    <label for="">Featured</label>
                                    <input type="checkbox" name="featured" >
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Monthly Offer</label>
                                <input type="checkbox" name="monthly_offer" >
                        </div>
                        <div class="col-md-4 mb-3">
                                <label for="">Weekly Offer</label>
                                <input type="checkbox" name="weekly_offer" >
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">Seasonal Offer</label>
                            <input type="checkbox" name="seasonal_offer" >
                    </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Upload Product Thumbnail Images</label>
                                    <input type="file" multiple name="image[]" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Upload Main Product Image</label>
                                    <input type="file"  name="large_image" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get department dropdown element
            var departmentSelect = document.getElementById('department_id');

            // Add event listener for change event
            departmentSelect.addEventListener('change', function() {
                // Get selected department option
                var selectedOption = departmentSelect.options[departmentSelect.selectedIndex];

                // Get department title from data attribute
                var departmentTitle = selectedOption.getAttribute('data-title');

                // Set department_title input value
                document.getElementById('department_title').value = departmentTitle;
            });

            // Get group dropdown element
            var groupSelect = document.getElementById('group_id');

            // Add event listener for change event
            groupSelect.addEventListener('change', function() {
                // Get selected group option
                var selectedOption = groupSelect.options[groupSelect.selectedIndex];

                // Get group title from data attribute
                var groupTitle = selectedOption.getAttribute('data-title');

                // Set group_title input value
                document.getElementById('group_title').value = groupTitle;
            });

            // Get sub-group dropdown element
            var subGroupSelect = document.getElementById('sub_group_id');

            // Add event listener for change event
            subGroupSelect.addEventListener('change', function() {
                // Get selected sub-group option
                var selectedOption = subGroupSelect.options[subGroupSelect.selectedIndex];

                // Get sub-group title from data attribute
                var subGroupTitle = selectedOption.getAttribute('data-title');

                // Set sub_group_title input value
                document.getElementById('sub_group_title').value = subGroupTitle;
            });
        });
    </script>
@endsection
