@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between my-2">
            <a href="{{ route('account#adminList') }}">
                <button class="btn btn-sm btn-secondary">Admin List</button>
            </a>

            <div>
                <form action="{{ route('account#userList') }}" method="get">
                    <div class="input-group">
                        <input type="text" name="searchKey"
                            value="{{ request('searchKey') }}"
                            class="form-control"
                            placeholder="Enter Search Key...">

                        <button type="submit" class="btn bg-dark text-white">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <table class="table table-hover shadow-sm text-center">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Created Date</th>
                            <th>Platform</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($user as $item)
                            <tr>
                                <td>
                                   
                                        <img class="img-profile img-thumbnail w-50" src="{{ $item->profile ? asset('profile/'.$item->profile) : asset('default/image.png') }}" alt="User Profile">
                                </td>
                                {{-- <td>
    @php
        $profileImage = asset('default/image.png'); // Default fallback
        
        if (!empty($item->profile)) {
            // Check if the profile string is already a full URL (Google/GitHub)
            if (filter_var($item->profile, FILTER_VALIDATE_URL)) {
                $profileImage = $item->profile;
            } else {
                // Otherwise, it's a locally uploaded file
                $profileImage = asset('profile/' . $item->profile);
            }
        }
    @endphp

    <img class="img-profile img-thumbnail rounded-circle" 
         style="width: 45px; height: 45px; object-fit: cover;"
         src="{{ $profileImage }}"
         alt="User Profile">
</td> --}}

                                <td>
                                    {{ $item->name != null ? $item->name : $item->nickname }}
                                </td>

                                <td>{{ $item->email }}</td>

                                <td>
                                    {!! $item->address != null
                                        ? e($item->address)
                                        : '<span style="color:red;opacity:0.6">no data...</span>' !!}
                                </td>

                                <td>
                                    {!! $item->phone != null
                                        ? e($item->phone)
                                        : '<span style="color:red;opacity:0.6">no data...</span>' !!}
                                </td>

                                <td>
                                    <span class="btn btn-sm bg-success text-white rounded shadow-sm">
                                        {{ $item->role }}
                                    </span>
                                </td>

                                <td>{{ $item->created_at->format('j-F-Y') }}</td>

                                <td>
                                    @if ($item->provider == 'google')
                                        <i class="fa-brands fa-google text-primary"></i>
                                    @endif

                                    @if ($item->provider == 'github')
                                        <i class="fa-brands fa-square-github text-primary"></i>
                                    @endif

                                    @if ($item->provider == 'simple')
                                        <i class="fa-solid fa-right-to-bracket text-primary"></i>
                                    @endif
                                </td>

                                <td>
                                    <button type="button"
                                        onclick="userDelete({{ $item->id }})"
                                        class="btn btn-sm btn-outline-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">
                                    <h5 class="text-muted text-center">There are no users.</h5>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <span class="d-flex justify-content-end">
                    {{ $user->links() }}
                </span>
            </div>
        </div>
    </div>
@endsection

@section('js-script')
    <script>
   function userDelete(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {

        if (result.isConfirmed) {

            Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success"
            });

            setInterval(() => {
                location.href = '/admin/account/user/delete/' + id;
            }, 1000);
        }

    });
}
   </script>
@endsection



