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
                        Sub Group List
                        <a href="{{ url('admin/subgroups/create') }}" class="btn btn-primary btn-sm text-white float-end">
                            Add Sub Group
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
                                <th>Group</th>
                                <th>Sub Group Title</th>
                                {{-- <th>Image</th> --}}
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subgroups as $subgroup)
                                <tr>
                                    <td>{{ $subgroup->id }}</td>
                                    <td>{{ $subgroup->group->group_title }}</td>
                                    <td>{{ $subgroup->sub_group_title }}</td>
                                    {{-- <td>
                                        <img src="{{asset("$subgroup->image")}}" style="width:70px; hieght:70px" alt="Slider">
                                    </td> --}}
                                    <td>{{ $subgroup->status}}</td>
                                    <td>
                                        <!-- Edit Icon -->
                                        <a href="{{ route('admin.subgroups.edit', $subgroup->id) }}" class="text-success" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                        <!-- Delete Icon with Confirmation -->
                                        <a href="{{ url('admin/subgroups/' . $subgroup->id . '/delete') }}" onclick="return confirm('Are you sure you want to delete this?')" class="text-danger" title="Delete">
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
