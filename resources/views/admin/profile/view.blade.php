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
                        <li><a href="{{ route('admin.events.index') }}">All Event List</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">View Event</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>View Event</h5>
                <hr>
                <div class="row m-0 details-page">
                    <div class="col-12 pt-3 pb-3 pl-0 pr-0">
                        <h5 class="text-blue">Basic details</h5>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" value="{{ \Illuminate\Support\Str::limit($event_details->title, 15) }}" readonly title="{{ $event_details->title }}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="title">Class Name</label>
                            <input type="text" id="title" value="@php
                            $class = App\Models\Classes::where('id',$event_details->class_id)->first();
                            echo $class->name;@endphp" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="start_date">Date</label>
                            <input type="text" id="start_date" value="{{ $event_details->start_date }} to {{ $event_details->end_date }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="end_date">Time</label>
                            <input type="text" id="end_date" value="{{ date('h:i A', strtotime($event_details->start_time)) }} to {{ date('h:i A', strtotime($event_details->end_time)) }}" readonly>
                        </div>
                    </div>
                    {{-- <div class="col-lg-3">
                        <div class="form-group">
                            <label for="duration">Duration in days</label>
                            <input type="text" id="duration" value="{{ $event_details->duration }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="fees">Fees(INR)</label>
                            <input type="text" id="fees" value="{{ $event_details->fees }}" readonly>
                        </div>
                    </div> --}}

                </div>
                @if ($event_details->image)
                    <div class="row m-0 details-page">
                        <div class="col-12 pt-3 pb-3 pl-0 pr-0">
                            <h5 class="text-blue">Others</h5>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <img src="{{ asset($event_details->image) }}" alt="" height="200" width="200">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Description</label>
                                {!! $event_details->desc !!}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
