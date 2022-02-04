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
                        <li><a href="#" class="active">Change Password</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5 class="font-weight-bold">Change Password</h5>
                <hr>
                @if (session('change_password_success_message'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ session('change_password_success_message') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  @endif
                  @if (session('change_password_warning'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{ session('change_password_warning') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  @endif
                <form action="{{ route('admin.updatePassword') }}" method="POST">
                    @csrf
                    <div class="row m-0 pt-3">
                        <div class="col-lg-12">
                            <div class="form-group edit-box">
                                <div class="form-group">
                                    <label class="control-label">Current password</label>
                                    <input type="password" class="form-control" name="old_password" id="old_password" value="{{ old('old_password') }}"  required />
                                    @if ($errors->change_password_warning->has('old_password'))
                                        <span style="color: red;">{{ $errors->change_password_warning->first('old_password') }}</span>
                                    @endif
                                  </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group edit-box">
                            <div class="form-group">
                                <label class="control-label">New Password</label>
                                <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}"  required />
                                @if ($errors->change_password_warning->has('password'))
                                    <span style="color: red;">{{ $errors->change_password_warning->first('password') }}</span>
                                @endif
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group edit-box">
                                <div class="form-group">
                                    <label class="control-label">Confirm password</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}"  required />
                                    @if ($errors->change_password_warning->has('password_confirmation'))
                                        <span style="color: red;">{{ $errors->change_password_warning->first('password_confirmation') }}</span>
                                    @endif
                                </div>
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
    <script>
        CKEDITOR.replace('desc');
    </script>
@endsection
