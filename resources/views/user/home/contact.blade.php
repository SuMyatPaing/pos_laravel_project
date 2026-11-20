
@extends('user.layouts.master')

@section('content')

<div class="container" style="margin-top: 150px; margin-bottom: 60px;">

    <div class="row justify-content-center">

        <div class="col-lg-8 col-md-10">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                <!-- Header -->
                <div class="card-header text-white p-4 border-0"
                     style="background-color: #81c408;">

                    <h3 class="mb-2 fw-bold">
                        <i class="fa-solid fa-envelope me-2"></i>
                        Contact Us
                    </h3>

                    <p class="mb-0 text-white">
                        Have a question or need assistance? Send us a message.
                    </p>

                </div>

                <!-- Form Body -->
                <div class="card-body p-4 p-md-5">

                    <form action="{{ route('user#contact') }}" method="POST">
                        @csrf

                        <!-- Subject -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Subject <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                name="title"
                                value="{{ old('title') }}"
                                class="form-control form-control-lg @error('title') is-invalid @enderror"
                                placeholder="Enter your subject">

                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        <!-- Message -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Your Message <span class="text-danger">*</span>
                            </label>

                            <textarea name="message"
                                rows="6"
                                class="form-control @error('message') is-invalid @enderror"
                                placeholder="Write your message here...">{{ old('message') }}</textarea>

                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        <!-- Submit -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                            <small class="text-muted">
                                <i class="fa-solid fa-lock me-1"></i>
                                Your message is private.
                            </small>

                            <button type="submit"
                                class="btn btn-lg px-4 text-white"
                                style="background-color: #81c408; border: none;">

                                Send Message
                                <i class="fa-solid fa-paper-plane ms-2"></i>

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
