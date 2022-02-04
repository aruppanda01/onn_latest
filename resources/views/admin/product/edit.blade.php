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
                        <li><a href="#" class="active">Edit Product</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>Edit Product</h5>
                <hr>
                <form action="{{ route('admin.product.update',$product_details->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row m-0 pt-3">
                        <input type="hidden" name="id" value="{{ $product_details->id }}">
                        <div class="col-lg-12">
                            <div class="form-group edit-box">
                                <label for="review">Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ $product_details->name ?? old('name') }}">
                                @if ($errors->has('name'))
                                    <span style="color: red;">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Category<span class="text-danger">*</span></label>
                                <select name="category" class="form-control" id="category">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $product_details->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category'))
                                    <span style="color: red;">{{ $errors->first('category') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Sub Category<span class="text-danger">*</span></label>
                                <select name="sub_category" class="form-control" id="category">
                                    <option value="">Select Sub Category</option>
                                    @foreach ($sub_categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $product_details->sub_category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('sub_category'))
                                    <span style="color: red;">{{ $errors->first('sub_category') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Available Sizes</label>
                                <?php
                                //get the old values from form
                                $old = old('available_sizes');

                                //get data from database table field
                                $ids = explode(',', $product_details->available_sizes);
                                //stay the values after form submission
                                if ($old) {
                                    $ids = $old;
                                }
                                ?>
                                <select id="choices-multiple-remove-button" class="form-control" name="available_sizes[]" multiple>
                                    @foreach ($available_product_sizes as $avl_size)
                                        <option value="{{ $avl_size->size }}" @php
                                            echo in_array($avl_size->size, $ids) ? 'selected' : '';
                                        @endphp>
                                            {{ $avl_size->size }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('available_sizes'))
                                    <span style="color: red;">{{ $errors->first('available_sizes') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Price<span class="text-danger">*</span></label>
                                <input type="number" id="price" class="form-control" name="price"
                                    value="{{ $product_details->price ?? old('price') }}" min="1">
                                @if ($errors->has('price'))
                                    <span style="color: red;">{{ $errors->first('price') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="review">Status<span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control">
                                    <option value="0" @if ($product_details->status == 0)
                                        selected @endif>Pending</option>
                                    <option value="1" @if ($product_details->status == 1)
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
                                @if ($product_details->image_path)
                                    <img src="{{ asset($product_details->image_path) }}" alt="" height="100" width="100">
                                @endif
                                @if ($errors->has('image'))
                                    <span style="color: red;">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group edit-box">
                                <label for="description">Description<span class="text-danger">*</span></label>
                                <textarea name="description">{{ $product_details->description }}</textarea>
                                @if ($errors->has('description'))
                                    <span style="color: red;">{{ $errors->first('description') }}</span>
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
            $(document).ready(function () {

            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
                // maxItemCount:5,
                // searchResultLimit:5,
                // renderChoiceLimit:5

            });
            $('.student_ids').select2();
            // var validated = false;
            // $('.error').hide();
            });
        CKEDITOR.replace('description');
    </script>
@endsection
