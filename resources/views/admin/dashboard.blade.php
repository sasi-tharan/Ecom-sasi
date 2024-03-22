@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            @if (session('message'))
                <h2 class="alert alert-success">{{ session('message') }}</h2>
            @endif
            <div class="me-md-3 me-xl-5">
                <h2>Dashboard</h2>
                <hr>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-body bg-primary text-white mb-3">
                        <label for="">Total Orders</label>
                        <h1></h1>
                        <a href="{{ url('admin/orders') }}" class="text-white">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-success text-white mb-3">
                        <label for="">Yearly Orders</label>
                        <h1> </h1>
                        <a href="{{ url('admin/orders') }}" class="text-white">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-danger text-white mb-3">
                        <label for="">Motnhly Orders</label>
                        <h1></h1>
                        <a href="{{ url('admin/orders') }}" class="text-white">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-warning text-white mb-3">
                        <label for="">Today Orders</label>
                        <h1></h1>
                        <a href="{{ url('admin/orders') }}" class="text-white">View</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card card-body bg-primary text-white mb-3">
                        <label for="">Total Products</label>
                        <h1></h1>
                        <a href="{{ url('admin/products') }}" class="text-white">View</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-body bg-success text-white mb-3">
                        <label for="">Total Categories</label>
                        <h1> </h1>
                        <a href="{{ url('admin/category') }}" class="text-white">View</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-body bg-danger text-white mb-3">
                        <label for="">Total Brands</label>
                        <h1></h1>
                        <a href="{{ url('admin/brands') }}" class="text-white">View</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card card-body bg-primary text-white mb-3">
                        <label for="">Total Users</label>
                        <h1></h1>
                        <a href="{{ url('admin/users') }}" class="text-white">View</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-body bg-success text-white mb-3">
                        <label for="">Total User</label>
                        <h1> </h1>
                        <a href="{{ url('admin/users') }}" class="text-white">View</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-body bg-danger text-white mb-3">
                        <label for="">Total Admin User</label>
                        <h1></h1>
                        <a href="{{ url('admin/users') }}" class="text-white">View</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
