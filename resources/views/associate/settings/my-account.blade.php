@extends('layouts.associate')
@section('title', 'My Account')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Claim Stack</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('associate-partner.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                            <li class="breadcrumb-item active">My Account</li>
                        </ol>
                    </div>
                    <h4 class="page-title">My Account</h4>
                </div>
            </div>
        </div>
        @include('associate.sections.flash-message')
        <!-- end page title -->

    </div> <!-- container -->

    <div class="row">
        <div class="col-12">
            <div class="card no-shadow">
                <div class="card-body">
                    <form id="accountForm" method="POST"
                        action="{{ route('associate-partner.my-account.update', Auth::guard('associate')->id()) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group  mb-2">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" maxlength="15"
                                placeholder="Enter Name" value="{{ old('name', $admin->name) }}">
                            @error('name')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group  mb-2">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" maxlength="30"
                                placeholder="Enter Email Address" value="{{ old('email', $admin->email) }}">
                            @error('email')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group  mb-2">
                            <label for="phone">Phone Number</label>
                            <input type="number" class="form-control" id="phone" name="phone"  pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length>10) return false;"
                                placeholder="Enter Phone Number" value="{{ old('phone', $admin->phone) }}">
                            @error('phone')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="avatar">Profile Picture</label>
                            <input type="file" class="form-control" id="avatar" name="avatar"
                            onchange="loadPreview(this);">
                            @if ($errors->has('avatar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('avatar') }}</strong>
                                </span>
                            @endif
                            <img id="preview_img" src="{{ $admin->avatar }}" class="mt-2" width="100"
                                height="100" />
                        </div>
                    </form>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success" form="accountForm">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function loadPreview(input, id) {
            id = id || '#preview_img';
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(id)
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush