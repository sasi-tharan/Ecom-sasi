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
                        <a href="{{ url('admin/subgroups/create') }}" class="btn btn-success btn-sm text-white me-2">
                            Add Sub Group
                        </a>
                        <button class="btn btn-success btn-sm text-white me-2" onclick="location.reload()">
                            Refresh
                        </button>
                    </h4>
                </div>
                <div class="card-body">
                    <table id="subgroupsTable" class="table table-bordered table-striped" style="border: 1px solid black;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid black;">ID</th>
                                <th style="border: 1px solid black;">Group</th>
                                <th style="border: 1px solid black;">Sub Group Title</th>
                                {{-- <th>Image</th> --}}
                                <th style="border: 1px solid black;">Status</th>
                                <th style="border: 1px solid black;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subgroups as $subgroup)
                                <tr style="border: 1px solid black;">
                                    <td style="border: 1px solid black;">{{ $subgroup->id }}</td>
                                    <td style="border: 1px solid black;">{{ $subgroup->group->group_title }}</td>
                                    <td style="border: 1px solid black;">{{ $subgroup->sub_group_title }}</td>
                                    {{-- <td>
                                        <img src="{{asset("$subgroup->image")}}" style="width:70px; height:70px; border: 1px solid black;" alt="Slider">
                                    </td> --}}
                                    <td style="border: 1px solid black;">{{ $subgroup->status }}</td>
                                    <td style="border: 1px solid black;">
                                        <!-- Action Buttons -->
                                        <div class="btn-group" role="group">
                                            <!-- Edit Icon -->
                                            <a href="{{ route('admin.subgroups.edit', $subgroup->id) }}" class="text-success" title="Edit">
                                                <i class="mdi mdi-pencil mdi-24px"></i>
                                            </a>
                                            <!-- Delete Icon with Confirmation -->
                                            <a href="{{ url('admin/subgroups/' . $subgroup->id . '/delete') }}" onclick="return confirm('Are you sure you want to delete this?')" class="text-danger" title="Delete">
                                                <i class="mdi mdi-delete mdi-24px"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Initialize DataTable on productsTable
            $('#subgroupsTable').DataTable();
        });
    </script>
@endsection
