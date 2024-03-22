@extends('layouts.admin')

@section('title','Edit User')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="card">

                <div class="card-header">
                    <h4>
                        Edit User
                        <a href="{{ url('admin/roles') }}" class="btn btn-danger btn-sm text-white float-end">
                            back
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert laert-warning">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                    <form action="{{ url('admin/roles/' .$role->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Role Name</label>
                                <input type="text" name="role_name" value="{{$role->role_name}}" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Description</label>
                                <input type="text" name="role_description"  value="{{$role->role_description}}" class="form-control" readonly />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Status</label>
                                <select name="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="active" {{$role->status == 'active' ? 'selected':''}}>Active</option>
                                    <option value="inactive" {{$role->status == 'inactive' ? 'selected':''}}>InActive</option>
                                </select>
                            </div>

                            <div class="col-md-12 text-end">
                                <button type="submit" name="" class="btn btn-primary">Update</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
