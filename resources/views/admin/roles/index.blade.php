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
                        <a href="{{ url('admin/roles/create') }}" class="btn btn-success btn-sm text-white me-2">
                            Add Roles
                        </a>
                        <button class="btn btn-success btn-sm text-white me-2" onclick="location.reload()">
                            Refresh
                        </button>
                    </h4>
                </div>
                <div class="card-body">
                    <table id="roleTable" class="table table-bordered table-striped" style="border: 1px solid black;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid black;">ID</th>
                                <th style="border: 1px solid black;">Role Name</th>
                                <th style="border: 1px solid black;">Description</th>
                                <th style="border: 1px solid black;">Status</th>
                                <th style="border: 1px solid black;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                                <tr style="border: 1px solid black;">
                                    <td style="border: 1px solid black;">{{ $role->id }}</td>
                                    <td style="border: 1px solid black;">{{ $role->role_name }}</td>
                                    <td style="border: 1px solid black;">{{ $role->role_description }}</td>
                                    <td style="border: 1px solid black;">{{ $role->status }}</td>
                                    <td style="border: 1px solid black;">
                                        <!-- Edit Icon with Link -->
                                        <div class="btn-group" role="group">
                                            <!-- Edit Icon -->
                                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="text-success" title="Edit">
                                                <i class="mdi mdi-pencil mdi-24px"></i>
                                            </a>
                                            <!-- Delete Icon with Confirmation -->
                                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#" class="text-danger" title="Delete" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this role?')) { this.parentNode.submit(); }">
                                                    <i class="mdi mdi-delete mdi-24px"></i>
                                                </a>
                                            </form>
                                        </div>


                                    </td>
                                </tr>
                            @empty
                                <tr style="border: 1px solid black;">
                                    <td colspan="5">No roles available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Initialize DataTable on productsTable
            $('#roleTable').DataTable();
        });
    </script>
@endsection
