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
                        Group List
                        <a href="{{ url('admin/groups/create') }}" class="btn btn-primary btn-sm text-white float-end">
                            Add Group
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
                                <th>Department</th>
                                <th>Group Title</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $group)
                                <tr>
                                    <td>{{ $group->id }}</td>
                                    <td>{{ $group->department->department_title }}</td>
                                    <td>{{ $group->group_title }}</td>
                                    <td>
                                        <img src="{{asset("$group->image")}}" style="width:70px; hieght:70px" alt="Slider">
                                    </td>
                                    <td>{{ $group->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <!-- Edit Icon -->
                                        <a href="{{ route('admin.groups.edit', $group->id) }}" class="text-success" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                        <!-- Delete Icon with Confirmation -->
                                        <a href="{{ url('admin/groups/' . $group->id . '/delete') }}" onclick="return confirm('Are you sure you want to delete this?')" class="text-danger" title="Delete">
                                            <i class="mdi mdi-delete"></i>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
