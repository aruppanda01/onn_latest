@extends('admin.layouts.master')
@section('content')
    <div class="dashboard-body" id="content">
        <div class="dashboard-content">
            <div class="row m-0 dashboard-content-header">
                <div class="col-lg-6 d-flex">
                    <a id="sidebarCollapse" href="javascript:void(0);">
                        <i class="fas fa-bars"></i>
                    </a>
                    <ul class="breadcrumb p-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="{{ route('admin.image.index') }}">All Image List</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">View Image</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>View Image</h5>
                <hr>
                    <div class="row m-0 pt-3">
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Image Capture Date<span class="text-danger">*</span></label>
                                <input type="date" name="capture_date" class="form-control" value="{{ $image_details->image_capture_date }}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Latitude<span class="text-danger">*</span></label>
                                <input type="text" name="latitude" value="{{ $image_details->lat ?? old('latitude') }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Longitude<span class="text-danger">*</span></label>
                                <input type="text" name="longitude" value="{{ $image_details->lon ?? old('longitude') }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Location<span class="text-danger">*</span></label>
                                <textarea name="location" id="" cols="3" rows="2" class="form-control" disabled>{{ $image_details->location ?? old('location') }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Image<span class="text-danger">*</span></label>
                                @if ($image_details->image_path)
                                    <img src="{{ asset($image_details->image_path) }}" alt="" height="200" width="200">
                                @endif
                            </div>
                        </div>

                    </div>
            </div>
        </div>
    </div>
@endsection
