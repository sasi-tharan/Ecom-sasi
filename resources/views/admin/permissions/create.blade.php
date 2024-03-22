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
                        <a href="{{ url('admin/users') }}" class="btn btn-danger btn-sm text-white float-end">
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
                    <form action="{{ url('admin/users') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Password</label>
                                <input type="text" name="password" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Name</label>
                                <select name="user_type" class="form-control">
                                    <option value="">Select Role</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                    <option value="staff">Staff</option> <!-- Add this line if staff is also a valid user type -->
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
