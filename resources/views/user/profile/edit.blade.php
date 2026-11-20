
@extends('user.layouts.master')

@section('content')

<div class="container-fluid" style="margin-top: 120px; margin-bottom: 50px;">

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                User Profile
                (<span class="text-danger">{{ Auth::user()->role }}</span>)
            </h6>
        </div>

        <form action="{{ route('user#updateProfile') }}"
            method="post" enctype="multipart/form-data">

            @csrf

            <div class="card-body">
                <div class="row">

                    {{-- Profile Image --}}
                    <div class="col-md-3 col-12 text-center mb-3">

                        <img class="img-profile img-thumbnail"
                            id="output"
                            src="{{ asset(Auth::user()->profile != null
                                ? 'profile/'.Auth::user()->profile
                                : 'default/image.png') }}"
                            style="width: 200px; height: 200px; object-fit: cover;">

                        <input type="file"
                            accept="image/*"
                            name="image"
                            class="form-control mt-2 @error('image') is-invalid @enderror"
                            onchange="loadFile(event)">

                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    {{-- User Information --}}
                    <div class="col-md-9 col-12">

                        <div class="row">

                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>

                                    <input type="text"
                                        name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Name..."
                                        value="{{ old('name', Auth::user()->name ?? Auth::user()->nickname) }}">

                                    @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>

                                    <input type="email"
                                        name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Email..."
                                        value="{{ old('email', Auth::user()->email) }}">

                                    @error('email')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>

                                    <input type="text"
                                        name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        placeholder="09xxxxxx"
                                        value="{{ old('phone', Auth::user()->phone) }}">

                                    @error('phone')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Address</label>

                                    <input type="text"
                                        name="address"
                                        class="form-control @error('address') is-invalid @enderror"
                                        placeholder="Enter Address..."
                                        value="{{ old('address', Auth::user()->address) }}">

                                    @error('address')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="my-2">
                            <a href="{{ route('user#changePasswordPage') }}">
                                Change Password
                            </a>
                        </div>

                        <input type="submit"
                            value="Update"
                            class="btn btn-primary mt-3">

                    </div>
                </div>
            </div>

        </form>
    </div>

</div>

@endsection

@section('js-script')

<script>
    var loadFile = function(event) {
        var image = document.getElementById('output');

        if (event.target.files && event.target.files[0]) {
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    };
</script>

@endsection
