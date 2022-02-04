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
							<li><a href="{{ route('admin.dashboard')}}">Home</a></li>
							<li class="text-white"><i class="fa fa-chevron-right"></i></li>
							<li><a href="{{ route('admin.sub-category.index')}}">All Sub Category List</a></li>
							<li class="text-white"><i class="fa fa-chevron-right"></i></li>
							<li><a href="#" class="active">Edit Sub Category</a></li>
						</ul>
					</div>
					@include('admin.layouts.navbar')
				</div>
				<hr>
				<div class="dashboard-body-content">
						<form action="{{ route('admin.sub-category.update',$category_details->id) }}" method="POST" enctype="multipart/form-data">
							@csrf
							@method('PUT')
                            <div class="row m-0 pt-3">
                                <input type="hidden" name="id" value="{{ $category_details->id }}">
                                <div class="col-lg-12">
                                    <div class="form-group edit-box">
                                        <label for="review">Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            value="{{ $category_details->name ?? old('name') }}">
                                        @if ($errors->has('name'))
                                            <span style="color: red;">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group edit-box">
                                        <label for="review">Category<span class="text-danger">*</span></label>
                                        <select name="category" class="form-control" id="category">
                                            @foreach ($category_list as $category)
                                                <option value="{{ $category->id }}" @if ($category_details->category_id == $category->id)
                                                    selected
                                                @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('name'))
                                            <span style="color: red;">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group edit-box">
                                        <label for="review">Status<span class="text-danger">*</span></label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="0" @if ($category_details->status == 0)
                                                selected @endif>Pending</option>
                                            <option value="1" @if ($category_details->status == 1)
                                                selected @endif>Active</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <span style="color: red;">{{ $errors->first('status') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group edit-box">
                                        <label for="review">Image<span class="text-danger">*</span></label>
                                        <input type="file" id="image" class="form-control" name="image"
                                            value="{{ old('image') }}">
                                        @if ($category_details->image_path)
                                            <img src="{{ asset($category_details->image_path) }}" alt="" height="100" width="100">
                                        @endif
                                        @if ($errors->has('image'))
                                            <span style="color: red;">{{ $errors->first('image') }}</span>
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
<script>
	CKEDITOR.replace( 'description' );
</script>
@endsection
