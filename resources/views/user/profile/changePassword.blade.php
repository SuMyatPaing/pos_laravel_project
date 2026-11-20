@extends('user.layouts.master')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid" style="margin-top: 150px; margin-bottom: 50px;">

        <div class="row">
            <div class="col-8 offset-2">

                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Change Password</h5>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('user#changePassword') }}" method="post" class="p-3 rounded">

                            @csrf

                            <!-- Old Password -->
                            <div class="mb-3">
                                <label class="form-label">Old Password</label>

                                <input type="password"
                                    name="oldPassword"
                                    class="form-control @error('oldPassword') is-invalid @enderror"
                                    placeholder="Enter Old Password...">

                                @error('oldPassword')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div class="mb-3">
                                <label class="form-label">New Password</label>

                                <input type="password"
                                    name="newPassword"
                                    class="form-control @error('newPassword') is-invalid @enderror"
                                    placeholder="Enter New Password...">

                                @error('newPassword')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>

                                <input type="password"
                                    name="confirmPassword"
                                    class="form-control @error('confirmPassword') is-invalid @enderror"
                                    placeholder="Enter Confirm Password...">

                                @error('confirmPassword')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="mt-4">
                                <button type="submit" class="btn btn-dark">
                                    Change Password
                                </button>

                                <a href="{{ route('user#profile') }}" class="btn btn-secondary">
                                    Back
                                </a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
