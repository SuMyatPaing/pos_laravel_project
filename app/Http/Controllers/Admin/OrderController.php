<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //
    public function orderList(){
        $orderList=Order::select('products.stock','products.id as product_id','orders.count','orders.id','orders.order_code','orders.created_at','orders.status','users.name')
                    ->leftJoin('users','orders.user_id','users.id')
                    ->leftJoin('products','orders.product_id','products.id')
                    ->when(request('searchKey'),function($query){
                     $query->whereAny(['orders.order_code','users.name'],'like','%'.request('searchKey').'%');
                     })
                    ->groupBy('order_code')
                    ->orderBy('orders.created_at','desc')
                    ->get();

        return view('admin.order.list',compact('orderList'));
    }
    //order details
    public function orderDetails($orderCode){
        $order=Order::select('users.name as user_name','users.phone','users.address','products.id as product_id','products.image','products.name as product_name','products.price','products.stock','orders.id as order_id','orders.order_code','orders.user_id','orders.count as order_count','orders.created_at')
                    ->leftJoin('products','orders.product_id','products.id')
                    ->leftJoin('users','orders.user_id','users.id')
                    ->where('order_code',$orderCode)
                    ->get();
                    //dd($order->toArray());
        $paymentHistory=PaymentHistory::select('payment_histories.*','payments.type as payment_type')
        ->leftJoin('payments','payments.id','payment_histories.payment_method')
        ->where('order_code',$orderCode)->first();
//false=>greater || true=>small
$status = true;

foreach ($order as $item) {
    if ($item->order_count <= $item->stock) {
        $status = true;
    } else {
        $status = false;
        break;
    }
}


        return view('admin.order.details',compact('order','paymentHistory','status'));
    }
    //order reject api
    public function orderReject(Request $request){
        // logger($request->all());
        Order::where('order_code',$request->orderCode)->update([
            'status'=>2
        ]);
        return response()->json([
            'status'=>'success',
            'message'=>'Order Reject Successfully'
            ],200);
    }
    //order status change api
    public function orderStatusChange(Request $request){
        // logger($request->all());
        Order::where('order_code',$request->order_code)->update([
           'status'=>$request->status,
        ]);
        return response()->json([
            'status'=>'success',
            'message'=>'Order Reject Successfully'
            ],200);
    }
    //order confirm
    // public function orderConfirm(Request $request){
    //      Order::where('order_code',$request[0]['orderCode'])->update([
    //         'status'=>1
    //     ]);
    // foreach($request->all() as $item){
    //     Product::where('id',$item['productId'])->decrement('stock',$item['productOrderCount']);
    //     return response()->json([
    //         'status'=>'success',
    //         'message'=>'Order Accept Successfully'
    //         ],200);
    // }
    // }

// order confirm
public function orderConfirm(Request $request)
{
    Order::where('order_code', $request[0]['orderCode'])->update([
        'status' => 1
    ]);

    foreach ($request->all() as $item) {

        Product::where('id', $item['productId'])
            ->decrement('stock', $item['productOrderCount']);

    }

    // Return AFTER the foreach loop finishes
    return response()->json([
        'status' => 'success',
        'message' => 'Order Accept Successfully'
    ], 200);
}
    //sale information
    public function saleInformation()
{
    $saleList = Order::select(
        'orders.order_code',
        'orders.created_at',
        'orders.status',
        'users.name'
    )
    ->leftJoin('users', 'orders.user_id', 'users.id')
    ->where('orders.status', 1)
    ->when(request('searchDate'), function($query) {
            $query->whereDate('orders.created_at', request('searchDate'));
        })
    ->groupBy('order_code',)
    ->orderBy('orders.created_at', 'desc')
    ->paginate(10);


    return view('admin.sale.saleInformation', compact('saleList'));
}
}
