@extends('admin.layouts.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <a href="{{ route('admin#orderList') }}" class=" text-black m-3"> <i class="fa-solid fa-arrow-left-long"></i> Back</a>

        <!-- DataTales Example -->


        <div class="row">
            <div class="card col-5 shadow-sm m-4 col">
                <div class="card-header  bg-primary text-white">
                    Register Customer Information
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-5">Name :</div>
                        <div class="col-7">{{ $order[0]->user_name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Phone :</div>
                        <div class="col-7">
                            {{ $order[0]->phone }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Address :</div>
                        <div class="col-7">
                            {{ $order[0]->address == null ? '...' : $order[0]->address }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Order Code :</div>
                        <div class="col-7" id="orderCode">{{ $order[0]->order_code }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Order Date :</div>
                        <div class="col-7">{{ $order[0]->created_at->format('j-F-Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Total Price :</div>
                        <div class="col-7">
                            {{ $paymentHistory->total_amt }}mmk<br>
                            <small class=" text-danger ms-1">( Contain Delivery Charges )</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card col-5 shadow-sm m-4 col">
                <div class="card-header bg-primary text-white">
                    Payment History Information
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-5">Contact Phone :</div>
                        <div class="col-7">{{ $paymentHistory->phone }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Address :</div>
                        <div class="col-7">{{ $paymentHistory->address }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Payment Method :</div>
                        <div class="col-7">{{ $paymentHistory->payment_type }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Purchase Date :</div>
                        <div class="col-7">{{ $paymentHistory->created_at->format('j-F-Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <img style="width: 150px" src="{{ asset('payslipImage/' . $paymentHistory->payslip_image) }}"
                            class=" img-thumbnail">
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                Product Order List
            </div>
            <div class="card-body">
                <table class="table table-hover shadow-sm table-data ">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="col-2">Image</th>
                            <th>Name</th>
                            <th>Order Count</th>
                            <th>Available Stock</th>
                            <th>Product Price (each)</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($order as $item)
                            <tr>
                                <input type="hidden" class="productId" value="{{ $item->product_id }}">
                                <input type="hidden" class="productOrderCount" value="{{ $item->order_count }}">

                                <td>
                                    <img src="{{ asset('productImage/' . $item->image) }}" class="w-50 img-thumbnail">
                                </td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->order_count }} @if ($item->order_count > $item->stock)
                                        <small class="text-danger">(out of stock!)</small>
                                    @endif
                                </td>
                                <td>{{ $item->stock }}</td>
                                <td>{{ $item->price }}mmk</td>
                                <td>{{ $item->price * $item->order_count }} mmk</td>
                            </tr>
                        @endforeach



                    </tbody>
                </table>

            </div>
        </div>

        <div class="card-footer text-end">
            <div class="">
      @if ($status)
                    <button type="button" id="btn-accept-order" class="btn btn-success rounded shadow-sm">Accept Order</button>
      @endif
                 <button type="button" id='btn-reject-order' class="btn btn-danger rounded shadow-sm">Reject Order</button>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
@section('js-script')
    <script>
        $(document).ready(function(){
          $('#btn-accept-order').click(function(){

    orderCode = $('#orderCode').text();
    orderList = [];

    $('.table-data tbody tr').each(function(index,row){

        productId = $(row).find('.productId').val();
        productOrderCount = $(row).find('.productOrderCount').val();

        orderList.push({
            'productId': productId,
            'productOrderCount': productOrderCount,
            'orderCode': orderCode,
        });

    });

    $.ajax({
        type: 'get',
        url: '/admin/order/confirm',
        data: Object.assign({}, orderList),
        dataType: 'json',

        success: function(res){
            if(res.status == 'success'){
                location.href = '/admin/order/list';
            } else {
                alert(res.message);
            }
        },

        error: function(xhr){
            console.log(xhr.responseText);
            alert(xhr.responseJSON?.message || 'Something went wrong!');
        }

    });

});

            $('#btn-reject-order').click(function(){
                //console.log('click');
                orderCode=$('#orderCode').text();
                //need to write api 
                $.ajax({
                    type:'get',
                    url:'/admin/order/reject',
                    data:{'orderCode':orderCode},
                    dataType:'json',
                    success:function(res){
                        res.status == 'success' ? location.href='/admin/order/list' : '';
                    }
                   
                })
            })
        })
    </script>
@endsection
