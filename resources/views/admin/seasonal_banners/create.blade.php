@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <h4>
                        Add Periodic Banner
                        <a href="{{url('admin/seasonal_banners')}}" class="btn btn-primary btn-sm text-white float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.seasonal_banners.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Offers</label><br/>
                                <select name="offers">
                                    <option value="monthly_offers">Monthly Offers</option>
                                    <option value="weekly_offers">Weekly Offers</option>
                                    <option value="seasonal_offers">Seasonal Offers</option>
                                </select>
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
                                <button type="submit" class="btn btn-primary float-end">Save</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
