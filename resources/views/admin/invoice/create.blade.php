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
                        <li><a href="{{ route('admin.invoice.index') }}">All Invoices List</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">Add Invoice</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>Add Invoice</h5>
                <hr>
                <form action="{{ route('admin.invoice.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row m-0 pt-3">
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Image<span class="text-danger">*</span></label>
                                <input type="file" name="image" class="form-control" id="image"
                                    value="{{ old('image') }}">
                                @if ($errors->has('image'))
                                    <span style="color: red;">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Invoice Date<span class="text-danger">*</span></label>
                                <input type="date" name="invoice_date" value="{{ old('invoice_date') }}" class="form-control">
                                @if ($errors->has('invoice_date'))
                                    <span style="color: red;">{{ $errors->first('invoice_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Amount<span class="text-danger">*</span></label>
                                <input type="number" name="amount" value="{{ old('amount') }}" class="form-control">
                                @if ($errors->has('amount'))
                                    <span style="color: red;">{{ $errors->first('amount') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Latitude<span class="text-danger">*</span></label>
                                <input type="text" name="latitude" value="{{ old('latitude') }}" class="form-control">
                                @if ($errors->has('latitude'))
                                    <span style="color: red;">{{ $errors->first('latitude') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Longitude<span class="text-danger">*</span></label>
                                <input type="text" name="longitude" value="{{ old('longitude') }}" class="form-control">
                                @if ($errors->has('longitude'))
                                    <span style="color: red;">{{ $errors->first('longitude') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Location<span class="text-danger">*</span></label>
                                <textarea name="location" id="" cols="3" rows="2" class="form-control">{{ old('location') }}</textarea>
                                @if ($errors->has('location'))
                                    <span style="color: red;">{{ $errors->first('location') }}</span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="actionbutton">SAVE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
