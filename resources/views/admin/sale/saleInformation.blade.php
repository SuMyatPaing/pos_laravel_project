 @extends('admin.layouts.master')

@section('content')
<div class="container-fluid">

    <h4 class="my-4">Sale Information</h4>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            Successful Order List
        </div>

        <div class="card-body">
            {{-- <form action="{{route('admin#saleInformation')}}" method="get" class="mb-3">
    <div class="input-group" style="max-width: 350px;">
        <input type="date" name="searchDate"
            value="{{ request('searchDate') }}"
            class="form-control">

        <button type="submit" class="btn btn-dark">
            <i class="fa-solid fa-magnifying-glass"></i> Search
        </button>
    </div>
</form> --}}

<form action="{{ route('admin#saleInformation') }}" method="get" class="mb-3">
    <div class="input-group" style="max-width: 450px;">

        <input type="date" name="searchDate"
            value="{{ request('searchDate') }}"
            class="form-control">

        <button type="submit" class="btn btn-dark">
            <i class="fa-solid fa-magnifying-glass"></i> Search
        </button>

        <a href="{{ route('admin#saleInformation') }}"
            class="btn btn-secondary">
            <i class="fa-solid fa-xmark"></i> Clear
        </a>

    </div>
</form>

            <table class="table table-hover">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Date</th>
                        <th>Order Code</th>
                        <th>Customer Name</th>
                        <th>Order Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($saleList as $item)
                    <tr>
                        <td>{{ $item->created_at->format('j-F-Y') }}</td>

                        <td>
                            <a href="{{ route('admin#orderDetails', $item->order_code) }}">
                                {{ $item->order_code }}
                            </a>
                        </td>

                        <td>{{ $item->name }}</td>

                        <td>
                            <span class="badge bg-success">Success</span>
                        </td>

                        <td>
                            <i class="fa-solid fa-check text-success"></i>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
               <span class="d-flex justify-content-end">{{  $saleList->links() }}</span>
        </div>
    </div>

</div>
@endsection