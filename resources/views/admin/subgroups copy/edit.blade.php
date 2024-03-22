@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <h4>
                        Edit Group
                        <a href="{{ url('admin/subgroups') }}" class="btn btn-primary btn-sm text-white float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/subgroups/' . $subgroup->id) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Group</label>
                                <select name="group_id" class="form-control" id="">
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}" {{ $subgroup->group_id == $group->id ? 'selected' : '' }}>
                                            {{ $group->group_title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Sub Group Title</label>
                                <input type="text" name="sub_group_title" value="{{ $subgroup->sub_group_title }}" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Image</label>
                                <img src="{{asset("$subgroup->image")}}" width="60px" height="60px" />
                                <input type="file" name="image" class="form-control"  >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Status</label><br/>
                                <input type="checkbox" name="status" {{ $subgroup->status == 1 ? 'checked' : '' }} />
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
