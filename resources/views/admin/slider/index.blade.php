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
                        Slider List
                        <a href="{{ url('admin/sliders/create') }}" class="btn btn-primary btn-sm text-white float-end">
                            Add Slider
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
                                <th>Slider Title</th>
                                <th>Description </th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{ $slider->id }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td>
                                        <img src="{{asset("$slider->image")}}" style="width:70px; hieght:70px" alt="Slider">
                                    </td>
                                    <td>{{ $slider->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td>
                                        <!-- Edit Icon -->
                                        <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="text-success" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                        <!-- Delete Icon with Confirmation -->
                                        <a href="{{ url('admin/sliders/' . $slider->id . '/delete') }}" onclick="return confirm('Are you sure you want to delete this?')" class="text-danger" title="Delete">
                                            <i class="mdi mdi-delete"></i>
                                        </a>
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
