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
                    <li><a href="{{ route('admin.sub-category.index') }}">All Sub Category List</a>
                    </li>
                    <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                    <li><a href="#" class="active">View category</a></li>
                </ul>
            </div>
            @include('admin.layouts.navbar')
        </div>
        <hr>
        <div class="dashboard-body-content">
            <div class="row m-0 pt-3">
                <div class="col-lg-12">
                    <div class="form-group edit-box">
                        <label for="review">Name<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" id="name"
                            value="{{ $category_details->name ?? old('name') }}" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group edit-box">
                        <label for="review">Category<span class="text-danger">*</span></label>
                        <input type="text" name="category" class="form-control" id="category"
                            value="{{ $category_details->category->name }}" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group edit-box">
                        <label for="review">Status<span class="text-danger">*</span></label>
                        @if($category_details->status == 0)
                            <input type="text" name="" id="" value="Pending" disabled class="form-control">
                        @else
                            <input type="text" name="" id="" value="Active" disabled class="form-control">
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group edit-box">
                        <label for="review">Image<span class="text-danger">*</span></label>
                        @if($category_details->image_path)
                            <img src="{{ asset($category_details->image_path) }}" alt="" height="200" width="200">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('description');

</script>
@endsection
