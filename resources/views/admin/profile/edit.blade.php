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
							<li><a href="{{ route('admin.courses.index')}}">All Courses List</a></li>
							<li class="text-white"><i class="fa fa-chevron-right"></i></li>
							<li><a href="#" class="active">Edit class</a></li>
						</ul>
					</div>
					@include('admin.layouts.navbar')
				</div>
				<hr>
				<div class="dashboard-body-content">
						<h5>Add Class</h5>
						<hr>
						<form action="{{ route('admin.courses.update',$course_details->id) }}" method="POST" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="row m-0 pt-3">
								<div class="col-lg-12">
									<div class="form-group edit-box">
										{{-- <label for="title">Course title</label> --}}
										<label for="review">Title<span class="text-danger">*</span></label>
										<input type="text" name="title" class="form-control" id="title" value="{{ $course_details->title }}">
										@if ($errors->has('title'))
											<span style="color: red;">{{ $errors->first('title') }}</span>
										@endif
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group edit-box">
										{{-- <label for="description">Description</label> --}}
										<label for="review">Description<span class="text-danger">*</span></label>
										<textarea name="description">{{ $course_details->description }}</textarea>
										@if ($errors->has('description'))
											<span style="color: red;">{{ $errors->first('description') }}</span>
										@endif
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
									{{-- <label for="image">Cover Image</label> --}}
									<label for="review">Cover Image<span class="text-danger">*</span></label>
									<input type="file" id="image" class="form-control" name="image">
									@if ($errors->has('image'))
										<span style="color: red;">{{ $errors->first('image') }}</span>
									@endif
									@if ($course_details->image)
										<img src="{{ asset($course_details->image) }}" alt="" height="100" width="100">
									@endif
								</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
									{{-- <label for="time">Assigned teacher</label> --}}
									<label for="review">Assigned teacher<span class="text-danger">*</span></label>
									<select class="form-control" name="teacher_id" id="teacher_id">
										<option value="">Please select teacher</option>
										@if($teachers)
										@foreach($teachers as $teacher)
										<option value="{{ $teacher->id }}" @if ($course_details->teacher_id == $teacher->id)
											selected
										@endif>{{ $teacher->first_name }} {{ $teacher->last_name }}</option>
										@endforeach
										@endif
									</select>
									@if ($errors->has('teacher_id'))
										<span style="color: red;">{{ $errors->first('teacher_id') }}</span>
									@endif
								</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
									{{-- <label for="start_date">Start Date</label> --}}
									<label for="review">Start Date<span class="text-danger">*</span></label>
									<input type="date" id="start_date" class="form-control" name="start_date" value="{{ $course_details->start_date }}">
									@if ($errors->has('start_date'))
										<span style="color: red;">{{ $errors->first('start_date') }}</span>
									@endif
								</div>
								</div>
								
								<div class="col-lg-6">
									<div class="form-group edit-box">
									{{-- <label for="end_date">End Date</label> --}}
									<label for="review">End Date<span class="text-danger">*</span></label>
									<input type="date" id="end_date" class="form-control" name="end_date" value="{{ $course_details->end_date }}" >
									@if ($errors->has('end_date'))
										<span style="color: red;">{{ $errors->first('end_date') }}</span>
									@endif
								</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
									{{-- <label for="fees">Fees</label> --}}
									<label for="review">Fees<span class="text-danger">*</span></label>
									<input type="number" id="fees" class="form-control" name="fees" value="{{ $course_details->fees }}">
									@if ($errors->has('fees'))
										<span style="color: red;">{{ $errors->first('fees') }}</span>
									@endif
								</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
									{{-- <label for="duration">Duration in days</label> --}}
									<label for="review">Duration in days<span class="text-danger">*</span></label>
									<input type="number" id="duration" class="form-control" name="duration" value="{{ $course_details->duration }}" >
									@if ($errors->has('duration'))
										<span style="color: red;">{{ $errors->first('duration') }}</span>
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