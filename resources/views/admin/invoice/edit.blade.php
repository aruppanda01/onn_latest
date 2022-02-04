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
                        <li><a href="#" class="active">Edit Invoice</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>Edit Invoice</h5>
                <hr>
                <form action="{{ route('admin.invoice.update',$invoice_details->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row m-0 pt-3">
                        <input type="hidden" name="id" value="{{ $invoice_details->id }}">
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Image<span class="text-danger">*</span></label>
                                <input type="file" name="image" class="form-control" id="image"
                                    value="{{ old('image') }}">
                                @if ($invoice_details->image_path)
                                    <img src="{{ asset($invoice_details->image_path ) }}" alt="" height="100" width="100">
                                @endif
                                @if ($errors->has('image'))
                                    <span style="color: red;">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Invoice Date<span class="text-danger">*</span></label>
                                <input type="date" name="invoice_date" value="{{ $invoice_details->invoice_date ?? old('invoice_date') }}" class="form-control">
                                @if ($errors->has('invoice_date'))
                                    <span style="color: red;">{{ $errors->first('invoice_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Amount<span class="text-danger">*</span></label>
                                <input type="number" name="amount" value="{{ $invoice_details->amount ??old('amount') }}" class="form-control">
                                @if ($errors->has('amount'))
                                    <span style="color: red;">{{ $errors->first('amount') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Latitude<span class="text-danger">*</span></label>
                                <input type="text" name="latitude" value="{{ $invoice_details->lat ??old('latitude') }}" class="form-control">
                                @if ($errors->has('latitude'))
                                    <span style="color: red;">{{ $errors->first('latitude') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Longitude<span class="text-danger">*</span></label>
                                <input type="text" name="longitude" value="{{ $invoice_details->lon ?? old('longitude') }}" class="form-control">
                                @if ($errors->has('longitude'))
                                    <span style="color: red;">{{ $errors->first('longitude') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Location<span class="text-danger">*</span></label>
                                <textarea name="location" id="" cols="3" rows="2" class="form-control">{{ $invoice_details->location ?? old('location') }}</textarea>
                                @if ($errors->has('location'))
                                    <span style="color: red;">{{ $errors->first('location') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Status<span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control">
                                    <option value="0" @if ($invoice_details->is_verified == 0)
                                        selected @endif>Not Verified</option>
                                    <option value="1" @if ($invoice_details->is_verified == 1)
                                        selected @endif>Verified</option>
                                </select>
                                @if ($errors->has('is_verified'))
                                    <span style="color: red;">{{ $errors->first('is_verified') }}</span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="actionbutton">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
