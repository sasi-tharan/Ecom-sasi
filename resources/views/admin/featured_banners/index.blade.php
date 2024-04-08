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
                    Featured Banner List
                    <button class="btn btn-success btn-sm text-white me-2" onclick="location.reload()">
                        Refresh
                    </button>
                    <a href="{{ url('admin/featured_banners/create') }}" class="btn btn-success btn-sm text-white me-2">
                        Add Featured Banner
                    </a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="border: 1px solid black;">ID</th>
                            <th style="border: 1px solid black;">Banner Title</th>
                            <th style="border: 1px solid black;">Dimension</th>
                            <th style="border: 1px solid black;">Image</th>
                            <th style="border: 1px solid black;">Status</th>
                            <th style="border: 1px solid black;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($featured_banners as $featured_banner)
                        <tr>
                            <td style="border: 1px solid black;">{{ $featured_banner->id }}</td>
                            <td style="border: 1px solid black;">{{ $featured_banner->title }}</td>
                            <td style="border: 1px solid black;">{{ $featured_banner->dimension }}</td>
                            <td style="border: 1px solid black;">
                                <img src="{{asset($featured_banner->image)}}" style="width:70px; height:70px" alt="Banner">
                            </td>
                            <td style="border: 1px solid black;">{{ $featured_banner->status == '1' ? 'Hidden' : 'Visible' }}</td>
                            <td style="border: 1px solid black;">
                                <div class="btn-group" role="group">
                                    <!-- Edit Icon -->
                                    <div>
                                        <a href="{{ route('admin.featured_banners.edit', $featured_banner->id) }}" class="text-success" title="Edit">
                                            <i class="mdi mdi-pencil mdi-24px"></i>
                                        </a>
                                    </div>

                                    <!-- Delete Icon with Confirmation -->
                                    <div>
                                        <a href="{{ url('admin/featured_banners/' . $featured_banner->id . '/delete') }}" onclick="return confirm('Are you sure you want to delete this?')" class="text-danger" title="Delete">
                                            <i class="mdi mdi-delete mdi-24px"></i>
                                        </a>
                                    </div>
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
@endsection
