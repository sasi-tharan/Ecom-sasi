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
                        <a href="{{ url('admin/seasonal_banners/create') }}" class="btn btn-success btn-sm text-white me-2">
                            Add Banner
                        </a>
                        <button class="btn btn-success btn-sm text-white me-2" onclick="location.reload()">
                            Refresh
                        </button>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="border: 1px solid black;">ID</th>
                                <th style="border: 1px solid black;">Offer Title</th>
                                <th style="border: 1px solid black;">Dimension</th>
                                <th style="border: 1px solid black;">Image</th>
                                <th style="border: 1px solid black;">Status</th>
                                <th style="border: 1px solid black;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($seasonalBanners as $banner)
                                <tr>
                                    <td style="border: 1px solid black;">{{ $banner->id }}</td>
                                    <td style="border: 1px solid black;">{{ $banner->offers }}</td>
                                    <td style="border: 1px solid black;">{{ $banner->dimension }}</td>
                                    <td style="border: 1px solid black;">
                                        <img src="{{ asset($banner->image) }}" style="width:70px; height:70px" alt="Banner">
                                    </td>
                                    <td style="border: 1px solid black;">{{ $banner->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td style="border: 1px solid black;">
                                        <div class="btn-group" role="group">
                                            <!-- Edit Icon -->
                                            <div>
                                                <a href="{{ route('admin.seasonal_banners.edit', $banner->id) }}" class="text-success" title="Edit">
                                                    <i class="mdi mdi-pencil mdi-24px"></i>
                                                </a>
                                            </div>

                                            <!-- Delete Icon with Confirmation -->
                                            <div>
                                                <a href="{{ url('admin/seasonal_banners/' . $banner->id . '/delete') }}" onclick="return confirm('Are you sure you want to delete this?')" class="text-danger" title="Delete">
                                                    <i class="mdi mdi-delete mdi-24px"></i>
                                                </a>
                                            </div>
                                        </div>
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
