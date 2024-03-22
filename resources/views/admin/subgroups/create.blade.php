@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Add Sub Group
                        <a href="{{ url('admin/subgroups') }}" class="btn btn-primary btn-sm text-white float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.subgroups.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="group_id">Group</label>
                                <select name="group_id" id="group_id" class="form-control" required>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->group_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sub_group_title">Sub Group Title</label>
                                <input type="text" name="sub_group_title" id="sub_group_title" class="form-control" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status">Status</label><br/>
                                <input type="checkbox" name="status" id="status" value="Active"> Active
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
