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
                        Periodic Banner List
                        <a href="{{ url('admin/seasonal_banners/create') }}" class="btn btn-primary btn-sm text-white float-end">
                            Add Banner
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
                                <th>Offer Title</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($seasonalBanners as $banner)
                                <tr>
                                    <td>{{ $banner->id }}</td>
                                    <td>{{ $banner->offers }}</td>
                                    <td>
                                        <img src="{{ asset($banner->image) }}" style="width:70px; height:70px" alt="Banner">
                                    </td>
                                    <td>{{ $banner->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td>
                                        <!-- Edit Icon -->
                                        <a href="{{ route('admin.seasonal_banners.edit', $banner->id) }}" class="text-success" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                        <!-- Delete Icon with Confirmation -->
                                        <a href="{{ url('admin/seasonal_banners/' . $banner->id . '/delete') }}" onclick="return confirm('Are you sure you want to delete this?')" class="text-danger" title="Delete">
                                            <i class="mdi mdi-delete"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <div>{{ $seasonalBanners->links() }}</div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
