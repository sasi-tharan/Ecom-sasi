@extends('layouts.admin')

@section('title', 'Permissions List')

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
                        Permissions
                    </h4>
                    <button class="btn btn-info btn-sm text-white me-2" onclick="location.reload()">
                        Refresh
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Role Name</th>
                                <th>Permissions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->role_name }}</td>
                                    <td></td>
                                    <td>
                                        <!-- Edit Icon -->
                                        <a href="{{ route('admin.permissions.edit', ['permission_id' => $permission->id]) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Delete Icon -->
                                        <form action="{{ route('admin.permissions.destroy', ['permission_id' => $permission->id]) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this role?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No permissions available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
