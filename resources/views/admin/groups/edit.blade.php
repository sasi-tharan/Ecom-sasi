@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <h4>
                        Edit Group
                        <a href="{{ url('admin/groups') }}" class="btn btn-primary btn-sm text-white float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/groups/' . $group->id) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Department</label>
                                <select name="department_id" class="form-control" id="">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" {{ $group->department_id == $department->id ? 'selected' : '' }}>
                                            {{ $department->department_title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Group Title</label>
                                <input type="text" name="group_title" value="{{ $group->group_title }}" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Image</label>
                                <img src="{{asset("$group->image")}}" width="60px" height="60px" />
                                <input type="file" name="image" class="form-control"  >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Status</label><br/>
                                <input type="checkbox" name="status" {{ $group->status == 1 ? 'checked' : '' }} />
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
