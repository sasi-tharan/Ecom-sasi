@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <h4>
                        Add Fetaured Banner
                        <a href="{{url('admin/featured_banners')}}" class="btn btn-success btn-sm text-white me-2">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{url ('admin/featured_banners/'.$featured_banner->id) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Title</label>
                                <input type="text" name="title" value="{{$featured_banner->title}}" class="form-control" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Dimension</label>
                                <textarea name="dimension" id=""  class="form-control"  rows="3">{{ $featured_banner->dimension}}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Image</label>
                                <img src="{{asset("$featured_banner->image")}}" width="60px" height="60px" />
                                <input type="file" name="image" class="form-control"  >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Status</label><br/>
                                <input type="checkbox" name="status" {{ $featured_banner->status == '1' ? 'checked':''}}  />
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-success btn-sm text-white me-2">Update</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection