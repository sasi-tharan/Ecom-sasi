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
                        <a href="{{ url('admin/departments/create') }}" class="btn btn-success btn-sm text-white me-2">
                            Add Department
                        </a>
                        <button class="btn btn-success btn-sm text-white me-2" onclick="location.reload()">
                            Refresh
                        </button>
                    </h4>
                </div>
                <div class="card-body">
                    <table id="departmentsTable" class="table table-bordered table-striped" style="border: 1px solid black;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid black;">ID</th>
                                <th style="border: 1px solid black;">Department Title</th>
                                <th style="border: 1px solid black;">Image</th>
                                <th style="border: 1px solid black;">Status</th>
                                <th style="border: 1px solid black;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments as $department)
                                <tr style="border: 1px solid black;">
                                    <td style="border: 1px solid black;">{{ $department->id }}</td>
                                    <td style="border: 1px solid black;">{{ $department->department_title }}</td>
                                    <td style="border: 1px solid black;">
                                        <img src="{{asset("$department->image")}}" style="width:70px; height:70px; border: 1px solid black;" alt="Slider">
                                    </td>
                                    <td style="border: 1px solid black;">{{ $department->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td style="border: 1px solid black;">
                                <!-- Edit Icon -->
                                <div class="btn-group" role="group">
                                    <!-- Edit Icon -->
                                    <a href="{{ url('admin/departments/' . $department->id . '/edit') }}" class="text-success" title="Edit">
                                        <i class="mdi mdi-pencil mdi-24px"></i>
                                    </a>
                                    <!-- Delete Icon with Confirmation -->
                                    <a href="{{ url('admin/departments/' . $department->id . '/delete') }}" onclick="return confirm('Are you sure you want to delete this?')" class="text-danger" title="Delete">
                                        <i class="mdi mdi-delete mdi-24px"></i>
                                    </a>
                                </div>




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
    <script>
        $(document).ready(function() {
            // Initialize DataTable on departmentsTable
            $('#departmentsTable').DataTable();
        });
    </script>
@endsection




