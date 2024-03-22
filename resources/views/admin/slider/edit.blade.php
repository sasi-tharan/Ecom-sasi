@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <h4>
                        Add Slider
                        <a href="{{url('admin/sliders')}}" class="btn btn-primary btn-sm text-white float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{url ('admin/sliders/'.$slider->id) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Title</label>
                                <input type="text" name="title" value="{{$slider->title}}" class="form-control" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Description</label>
                                <textarea name="description" id=""  class="form-control"  rows="3">{{ $slider->description}}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Image</label>
                                <img src="{{asset("$slider->image")}}" width="60px" height="60px" />
                                <input type="file" name="image" class="form-control"  >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Status</label><br/>
                                <input type="checkbox" name="status" {{ $slider->status == '1' ? 'checked':''}}  />
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary float-end">Update</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
