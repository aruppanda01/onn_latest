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
                        <li><a href="#" class="active">Edit Image</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>Edit Image</h5>
                <hr>
                <form action="{{ route('admin.image.update',$image_details->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row m-0 pt-3">
                        <div class="col-lg-6">
                            <input type="hidden" name="id" value="{{ $image_details->id }}">
                            <div class="form-group edit-box">
                                <label for="review">Image<span class="text-danger">*</span></label>
                                <input type="file" name="image" class="form-control" id="image"
                                    value="{{ old('image') }}">
                                @if ($image_details->image_path)
                                    <img src="{{ asset($image_details->image_path) }}" alt="" height="100" width="100">
                                @endif
                                @if ($errors->has('image'))
                                    <span style="color: red;">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Image Capture Date<span class="text-danger">*</span></label>
                                <input type="date" name="capture_date" class="form-control" value="{{ $image_details->image_capture_date }}">
                                @if ($errors->has('capture_date'))
                                    <span style="color: red;">{{ $errors->first('capture_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Latitude<span class="text-danger">*</span></label>
                                <input type="text" name="latitude" value="{{ $image_details->lat ?? old('latitude') }}" class="form-control" >
                                @if ($errors->has('latitude'))
                                    <span style="color: red;">{{ $errors->first('latitude') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Longitude<span class="text-danger">*</span></label>
                                <input type="text" name="longitude" value="{{ $image_details->lon ?? old('longitude') }}" class="form-control">
                                @if ($errors->has('longitude'))
                                    <span style="color: red;">{{ $errors->first('longitude') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Status<span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control">
                                    <option value="0" @if ($image_details->status == 0)
                                        selected @endif>Pending</option>
                                    <option value="1" @if ($image_details->status == 1)
                                        selected @endif>Active</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span style="color: red;">{{ $errors->first('status') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Location<span class="text-danger">*</span></label>
                                <textarea name="location" id="" cols="3" rows="2" class="form-control">{{ $image_details->location ?? old('location') }}</textarea>
                                @if ($errors->has('location'))
                                    <span style="color: red;">{{ $errors->first('location') }}</span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="actionbutton">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
