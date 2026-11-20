@extends('admin.layouts.master')
@section('content')
<div class="container">
                    <div class=" d-flex justify-content-between my-2">
                        <div class=""></div>
                        <div class="">
                            <form action="{{ route('admin#orderList') }}" method="get">

                                <div class="input-group">
                                    <input type="text" name="searchKey" value="{{ request('searchKey') }}" class=" form-control mx-4"
                                        placeholder="Search order code or  customer name...">
                                    <button type="submit" class=" btn bg-dark text-white"> <i
                                            class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                      <div class="row">
                        <div class="col">
                           <div class=row>
                            <div class="col-6">
                                 {{-- <div class="alert theme-warning" role="alert">
 <span><strong> <i class="fa-solid fa-triangle-exclamation text-warning me-3"></i></strong>You can click order code to see order details</span>
  <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
</div> --}}
<div class="alert alert-warning alert-dismissible fade show" role="alert">

    <i class="fa-solid fa-triangle-exclamation me-2"></i>

    You can click order code to see order details

    <button type="button" class="btn-close"
        data-bs-dismiss="alert" aria-label="Close">
    </button>

</div>
                            </div>
                           </div>
                            <table class="table table-hover shadow-sm ">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Date</th>
                                        <th>Order Code</th>
                                         <th>Customer Name</th>
                                        <th>Order Status</th>
                                     <th></th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($orderList) != 0)
                                @foreach($orderList as $item)
                               <tr>

                                        <td>{{$item->created_at->format('j-F-Y')}}</td>
                                        <td><a href="{{route('admin#orderDetails',$item->order_code)}}" class="orderCode">{{$item->order_code}}</a></td>
                                         <td>{{$item->name}}</td>
                                        <td>
                                            <select name="" id="" class="form-select statusChange">
                                                 <option value="0" @if ($item->status == 0) selected @endif>Pending</option>
                                               @if($item->count <= $item->stock)
                                                <option value="1" @if ($item->status == 1) selected @endif>Success</option>
                                               @endif
                                                <option value="2" @if ($item->status == 2) selected @endif>Reject</option>

                                            </select>
                                        </td>
                                        <td>

                                              @if ($item->status == 0)
                            <i class="fa-solid fa-spinner text-warning"></i>

                            @elseif($item->status == 1)
                            <i class="fa-solid fa-check text-success"></i>
                            @else
                                <i class="fa-solid fa-xmark text-danger"></i>
                            @endif
                                        </td>
                               </tr>
                                @endforeach

                                @else


                                    <tr>
                                        <td colspan="7">
                                            <h5 class="text-muted text-center">There is no data</h5>
                                        </td>
                                    </tr>
                                    @endif



                                </tbody>
                            </table>



                        </div>
                    </div>

                </div>
@endsection
@section('js-script')
    <script>
        $(document).ready(function(){
            $('.statusChange').change(function(){

                // orderCode=$('#orderCode').text();
               status=$(this).val();//current value
               //console.log(status);
               //need to get ordercode
               orderCode=$(this).parents('tr').find('.orderCode').text();
               //console.log(orderCode);
               data={
                'order_code':orderCode,
                'status' :status

               };
                $.ajax({
                    type:'get',
                    url:'/admin/order/statusChange',
                    data:data,
                    dataType:'json',
                    success:function(response){
                        response.status == 'success' ? location.reload(): '';
                    }

                })
            })
        })
    </script>
@endsection