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
                        <li><a href="{{ route('admin.product.index') }}">All Product List</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">View Product</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>View Product</h5>
                <hr>
                    <div class="row m-0 pt-3">
                        <div class="col-lg-12">
                            <div class="form-group edit-box">
                                <label for="review">Name</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ $product_details->name ?? old('name') }}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Category</label>
                                <input type="text" name="" id="" value="{{ $product_details->category->name }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Sub Category</label>
                                <input type="text" name="" id="" value="{{ $product_details->sub_category->name }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Available Sizes </label>
                                <input type="text" value="{{ $product_details->available_sizes }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Price</label>
                                <input type="number" id="price" class="form-control" name="price"
                                    value="{{ $product_details->price ?? old('price') }}" min="1" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Status</label>
                                    @if ($product_details->status == 0)
                                    <input type="text" name="" id="" value="Pending" class="form-control" disabled>
                                    @else
                                    <input type="text" name="" id="" value="Active" class="form-control" disabled>
                                    @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Image</label>
                                @if ($product_details->image_path)
                                    <img src="{{ asset($product_details->image_path) }}" alt="" height="200" width="200">
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group edit-box">
                                <label for="description">Description</label>
                                <div class="mt-2">
                                    {!! $product_details->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        CKEDITOR.replace('description');
    </script>
@endsection
