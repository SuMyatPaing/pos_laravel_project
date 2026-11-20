@extends('admin.layouts.master')
@section('content')
    <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        {{-- <h1 class="h3 mb-0 text-gray-800">Category</h1> --}}
                    </div>

                    <div class="">
                        <div class="row">
                            <div class="col-4 offset-4">
                                <div class="card">
                                    <div class="card-title">
                                        <a href="{{ route('payment#list') }}" class="btn btn-sm bg-dark mt-2 mx-2 text-white rounded shadow-sm">Back</a>
                                    </div>
                                    <div class="card-body shadow">
                                        <form action="{{route('payment#update',$payment->id) }}" method="post" class="p-3 rounded">
                                            @csrf
                                            <input type="text" name="accountNumber" value="{{ old('accountNumber',$payment->account_number)}}"
                                                class=" form-control @error('accountNumber') is-invalid @enderror "
                                                placeholder=" Account Number...">
                                                 @error('accountNumber')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                   @enderror
                                    
                                    <input type="text" name="accountName" value="{{ old('accountName',$payment->account_name)}}"
                                                class=" form-control @error('accountName') is-invalid @enderror "
                                                placeholder=" Account Name...">
                                                 @error('accountName')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                   @enderror

                                   <input type="text" name="type" value="{{ old('type',$payment->type)}}"
                                                class=" form-control @error('type') is-invalid @enderror "
                                                placeholder="KBZ Pay,CB Pay,etc...">
                                                 @error('type')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                   @enderror
                                            <input type="submit" value="Update" class="btn btn-outline-primary mt-3">
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
@endsection
