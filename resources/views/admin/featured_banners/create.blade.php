@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <h4>
                        Add Featured Banner
                        <a href="{{url('admin/featured_banners')}}" class="btn btn-success btn-sm text-white me-2">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.featured_banners.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Title</label>
                                <input type="text" name="title" class="form-control" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Dimension</label>
                                <textarea name="dimension" id=""  class="form-control"  rows="3"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Image</label>
                                <input type="file" name="image" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Status</label><br/>
                                <input type="checkbox" name="status"  />
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-success btn-sm text-white me-2">Save</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
