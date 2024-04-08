@extends('layouts.admin')

@section('title', 'Users List')

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
                        Users
                        <a href="{{ url('admin/users/create') }}" class="btn btn-success btn-sm text-white me-2">
                            Add Users
                        </a>
                        <button class="btn btn-success btn-sm text-white me-2" onclick="location.reload()">
                            Refresh
                        </button>
                    </h4>
                </div>
                <div class="card-body">
                    <table id="usersTable" class="table table-bordered table-striped" style="border: 1px solid black;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid black;">ID</th>
                                <th style="border: 1px solid black;">Name</th>
                                <th style="border: 1px solid black;">Email</th>
                                <th style="border: 1px solid black;">Role</th>
                                <th style="border: 1px solid black;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr style="border: 1px solid black;">
                                <td style="border: 1px solid black;">{{ $user->id }}</td>
                                <td style="border: 1px solid black;">{{ $user->name }}</td>
                                <td style="border: 1px solid black;">{{ $user->email }}</td>
                                <td style="border: 1px solid black;">
                                    {{ $user->role ? $user->role : 'None' }}
                                </td>
                                <td style="border: 1px solid black;">
                                    <!-- Action Buttons -->
                                    <div class="btn-group" role="group">
                                        <!-- Edit Icon -->
                                        <a href="{{ url('admin/users/' . $user->id . '/edit') }}" class="text-success" title="Edit">
                                            <i class="mdi mdi-pencil mdi-24px"></i>
                                        </a>
                                        <!-- Delete Icon with Confirmation -->
                                        <a href="{{ url('admin/users/' . $user->id . '/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="text-danger" title="Delete">
                                            <i class="mdi mdi-delete mdi-24px"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr style="border: 1px solid black;">
                                <td colspan="5">No User Available</td>
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
            // Initialize DataTable on usersTable
            $('#usersTable').DataTable();
        });
    </script>

@endsection



