@extends('layouts.admin')

@section('title','Add User')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="card">

                <div class="card-header">
                    <h4>
                        Add Users
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
                    <form action="{{ url('admin/roles') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Role Name</label>
                                <input type="text" name="role_name" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Description</label>
                                <input type="text" name="role_description" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Status</label>
                                <select name="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-12 text-end">
                                <button type="submit" name="" class="btn btn-primary">Save</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
