@extends('layouts.admin')

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
                        Department List
                        <a href="{{ url('admin/departments/create') }}" class="btn btn-primary btn-sm text-white float-end">
                            Add Department
                        </a>
                        <button class="btn btn-info btn-sm text-white me-2" onclick="location.reload()">
                            Refresh
                        </button>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Department Title</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                              @foreach ($departments as $department)
                                <tr>
                                    <td>{{ $department->id }}</td>
                                    <td>{{ $department->department_title }}</td>
                                    <td>
                                        <img src="{{asset("$department->image")}}" style="width:70px; hieght:70px" alt="Slider">
                                    </td>
                                    <td>{{ $department->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td>
                                        <!-- Edit Icon -->
                                        <a href="{{ url('admin/departments/' . $department->id . '/edit') }}" class="text-success" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                        <!-- Delete Icon with Confirmation -->
                                        <a href="{{ url('admin/departments/' . $department->id . '/delete') }}" onclick="return confirm('Are you sure you want to delete this?')" class="text-danger" title="Delete">
                                            <i class="mdi mdi-delete"></i>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                        {{-- <div>{{ $products->links() }}</div> --}}
                    </div>
                </div>
            </div>
        </div>
    @endsection
