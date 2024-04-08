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
                        <a href="{{ url('admin/users') }}" class="btn btn-success btn-sm text-white me-2">
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
                    <form action="{{ url('admin/users/' .$user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{$user->name}}" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Email</label>
                                <input type="email" name="email"  value="{{$user->email}}" class="form-control" readonly />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" value="{{$user->password}}" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="role">Role</label>
                                <select name="role" class="form-control" id="role">
                                    <option value="">Select Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->role == $role->id ? 'selected' : '' }}>
                                            {{ $role->role_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="col-md-12 text-end">
                                <button type="submit" name="" class="btn btn-success btn-sm text-white me-2">Update</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
