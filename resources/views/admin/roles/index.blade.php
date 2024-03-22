@extends('layouts.admin')

@section('title', 'Roles List')

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
                        Roles
                        <a href="{{ url('admin/roles/create') }}" class="btn btn-primary btn-sm text-white float-end">
                            Add Roles
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
                                <th>Role Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->role_name }}</td>
                                    <td>{{ $role->role_description }}</td>
                                    <td>{{ $role->status }}</td>
                                    <td>
                                        <!-- Edit Icon with Link -->
                                        <a href="{{ url('admin/roles/' . $role->id . '/edit') }}" class="text-success" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <!-- Delete Icon with Link -->
                                        <a href="{{ route('admin.roles.destroy', $role->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $role->id }}').submit();" class="text-danger" title="Delete">
                                            <i class="fa fa-trash-alt"></i>
                                        </a>

                                        <!-- Delete Form -->
                                        <form id="delete-form-{{ $role->id }}" action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No roles available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
