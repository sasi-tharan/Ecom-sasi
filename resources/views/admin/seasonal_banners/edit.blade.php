@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Periodic Banner</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.seasonal_banners.update', $seasonal_banner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Offers</label><br />
                            <select name="offers" class="form-control">
                                <option value="monthly_offers" {{ $seasonal_banner->offers == 'monthly_offers' ? 'selected' : '' }}>Monthly Offers</option>
                                <option value="weekly_offers" {{ $seasonal_banner->offers == 'weekly_offers' ? 'selected' : '' }}>Weekly Offers</option>
                                <option value="seasonal_offers" {{ $seasonal_banner->offers == 'seasonal_offers' ? 'selected' : '' }}>Seasonal Offers</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control" />
                            <img src="{{ asset($seasonal_banner->image) }}" style="width: 100px; height: auto;" alt="Current Image">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Status</label><br />
                            <input type="checkbox" name="status" {{ $seasonal_banner->status == '1' ? 'checked' : '' }} />
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
