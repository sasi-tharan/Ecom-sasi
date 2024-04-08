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
                        <a href="{{ url('admin/sliders/create') }}" class="btn btn-success btn-sm text-white me-2">
                            Add Slider
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
                                <th style="border: 1px solid black;">Slider Title</th>
                                <th style="border: 1px solid black;">Dimension</th>
                                <th style="border: 1px solid black;">Image</th>
                                <th style="border: 1px solid black;">Status</th>
                                <th style="border: 1px solid black;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                                <tr>
                                    <td style="border: 1px solid black;">{{ $slider->id }}</td>
                                    <td style="border: 1px solid black;">{{ $slider->title }}</td>
                                    <td style="border: 1px solid black;">{{ $slider->description }}</td>
                                    <td style="border: 1px solid black;">
                                        <img src="{{ asset($slider->image) }}" style="width:70px; height:70px" alt="Slider">
                                    </td>
                                    <td style="border: 1px solid black;">{{ $slider->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td style="border: 1px solid black;">
                                        <div class="btn-group" role="group">
                                            <!-- Edit Icon -->
                                            <div>
                                                <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="text-success" title="Edit">
                                                    <i class="mdi mdi-pencil mdi-24px"></i>
                                                </a>
                                            </div>

                                            <!-- Delete Icon with Confirmation -->
                                            <div>
                                                <a href="{{ url('admin/sliders/' . $slider->id . '/delete') }}" onclick="return confirm('Are you sure you want to delete this?')" class="text-danger" title="Delete">
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
