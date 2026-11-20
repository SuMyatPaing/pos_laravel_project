<?php
namespace App\Http\Controllers\User;
use App\Models\Cart;
use App\Models\User;

use App\Models\Order;
use App\Models\Rating    ;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
class UserController extends Controller
{

    public function home()
    {

        $products = Product::select(
            'products.id',
            'products.name',
            'products.price',
            'products.description',
            'products.image',
            'products.category_id',
            'categories.name as category_name'
        )
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->when(request('categoryId'), function ($query) {
                $query->where('products.category_id', request('categoryId'));
            })
            ->when(request('searchKey'), function ($query) {
                $query->where('products.name', 'like', '%' . request('searchKey') . '%');
            })
            //min:true | max:true
            ->when(request('minPrice') != null && (request('maxPrice') != null), function ($query) {
                $query->whereBetween('products.price', [request('minPrice'), request('maxPrice')]);
            })
            //min:true | max:false
            ->when(request('minPrice') != null && (request('maxPrice') == null), function ($query) {
                $query->where('products.price', '>=', request('minPrice'));
            })
            //min:false | max:true
            ->when(request('minPrice') == null && (request('maxPrice') != null), function ($query) {
                $query->where('products.price', '<=', request('maxPrice'));
            })
            // ->orderBy('products.created_at', 'desc')
            //order by date:string:digit
            // ->when(request('sortingType'),function($query){
            //     $sortingRules=explode(',',request('sortingType'));

            //     $query->orderBy('products.'. $sortingRules[0], $sortingRules[1]);//(fieldName,asc|desc)
            // })
    ->when(request('sortingType'), function($query) {
    $sortingRules = explode(',', request('sortingType'));

    $query->orderBy('products.' . $sortingRules[0], $sortingRules[1]);
}, function($query) {
    $query->orderBy('products.created_at', 'desc');
})

            ->get();
        $categories = Category::select('id', 'name')->get();

        return view('user.home.list', compact('products', 'categories'));
    }
    //direct product details page
    public function productDetails($id){
        // $product=Product::where('id',$id)->get();//0 starts
        // $product=Product::where('id',$id)->first();
       $product = Product::select(
            'products.id',
            'products.name',
            'products.price',
             'products.stock',
            'products.description',
            'products.image',
            'products.category_id',
            'categories.name as category_name'
        )
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.id',$id)
            ->first();

    // $productList=Product::select(
    //         'products.id',
    //         'products.name',
    //         'products.price',
    //         'products.description',
    //         'products.image',
    //         'products.category_id',
    //         'categories.name as category_name'
    //     )
    //         ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
    //         ->get();
    $comment=Comment::select('comments.id as comment_id','comments.message','comments.created_at','users.id as user_id','users.profile','users.name')
         ->where('comments.product_id',$id)
         ->leftJoin('users','users.id','comments.user_id')
         ->orderBy('comments.created_at','desc')
        ->get();

    $stars=Rating::where('product_id',$id)->avg('count');
    $stars=number_format($stars);
    // 3.4=3 3.4=4
    $userRating=Rating::where('product_id',$id)
                ->where('user_id',Auth::user()->id)
                ->value('count');

        return view('user.home.details',compact('product','comment','stars','userRating'));
        //dd($comment->toArray());

    }
  // Comment
public function comment(Request $request)
{
    $request->validate([
        'productId' => 'required|exists:products,id',
        'comment' => 'required|string'
    ]);

    Comment::create([
        'product_id' => $request->productId,
        'user_id' => Auth::id(),
        'message' => $request->comment
    ]);

    Alert::success('Success', 'Comment added successfully!');

    return back();
}
    //delete comment
    public function commentDelete($id){
        Comment::where('id',$id)->delete();
        return back();
    }
    //rating
     public function rating(Request $request){
    //     Rating::create([
    //     'product_id' => $request->productId,
    //     'user_id' => Auth::id(),
    //     'count' => $request->productRating
    // ]);

    Rating::updateOrCreate([
        'user_id' =>Auth::user()->id,
        'product_id' =>$request->productId
    ],
    [
        'product_id' => $request->productId,
        'user_id' => Auth::user()->id,
        'count' => $request->productRating
    ]);

    Alert::success('Success', 'Rating added successfully!');

    return back();

     }

//direct cart page
public function cart()
{
    $cart = Cart::select(
        'carts.id as cart_id',
        'carts.qty',
        'products.id as product_id',
        'products.image',
        'products.name',
        'products.price'
    )
    ->leftJoin('products', 'carts.product_id', '=', 'products.id')
    ->where('carts.user_id', Auth::user()->id)
    ->get();
    // total price pull
    $totalPrice=0;
    foreach($cart as $item){
        $totalPrice += $item->price * $item->qty;
    }
    return view('user.home.cart', compact('cart','totalPrice'));
}

//add to cart page
public function addToCart(Request $request){
    //dd(request->all());
    Cart::create([
        'user_id' => $request->userId,
        'product_id' => $request->productId,
        'qty' => $request->qty,
    ]);
     Alert::success('Add To Cart Success', 'Add To Cart created successfully!');

    return back();
}

//card delete process
//api call write
public function cardDelete(Request $request){
    $cartId=$request['cartId'];
    Cart::where('id',$cartId)->delete();
    return response()->json([
        'status'=>'success',
        'message'=>'Card Deleted Successfully'
        ],200);
}


//temporary storage
public function tempStorage(Request $request){
    // logger($request->all());
    $orderTemp=[];
    foreach($request->all() as $item){
    array_push( $orderTemp,[
    'user_id'  =>$item['user_id'],
    'product_id' =>$item['product_id'],
    'count'=>$item['count'],
    'status'=>$item['status'],
    'order_code'=>$item['order_code'],
    'finalAmt'=>$item['totalAmt'],
        ]);
    }
    Session::put('tempCart',$orderTemp);
     return response()->json([
        'status'=>'success',
        'message'=>'Temp Storage Store Successfully'
        ],200);


}


//direct payment page
public function paymentPage()
{
    $paymentAcc = Payment::select('id', 'account_name', 'account_number', 'type')
        ->orderBy('type', 'asc')
        ->get();

    $orderTemp = Session::get('tempCart');

    // dd($orderTemp);

    return view('user.home.payment', compact('paymentAcc', 'orderTemp'));
}
//order process
public function order(Request $request){
    $request->validate([
        'name'=>'required|string|max:255',
        'phone' => 'required|string|regex:/^[0-9]{9,15}$/',
        'address' => 'required|string|max:255',
        // 'paymentType' => 'required|exists:payments,id',
        'paymentType' => 'required',
        'payslipImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    ]);
    $orderTemp=Session::get('tempCart');
    // dd($orderTemp);
    $paymentHistoryData=[
        'user_name'=>$request->name,
        'phone' => $request->phone,
        'address' => $request->address,
        'payment_method' => $request->paymentType,
        'order_code' => $request->orderCode,
       'total_amt' => (int) str_replace(' mmk', '', $request->totalAmount),
    ];
    if($request->hasFile('payslipImage')){
        $file=$request->file('payslipImage');
        $fileName=uniqid().'_'.$file->getClientOriginalName();
        $file->move(public_path().'/payslipImage/',$fileName);
        $paymentHistoryData['payslip_image']=$fileName;
    }
    PaymentHistory::create($paymentHistoryData);
    // Order::create($orderTemp); because of mass assignment error, we will use foreach loop to create each order
    foreach($orderTemp as $item){
        Order::create([
                        'product_id' => $item['product_id'],
            'user_id' => $item['user_id'],

            'count' => $item['count'],
            'status' => $item['status'],
            'order_code' => $item['order_code'],
            ]);

               Cart::where('user_id', $item['user_id'])
              ->where('product_id', $item['product_id'])
              ->delete();
        }



             Alert::success('Thank for your order!', 'Order Created successfully!');
            // return back();
            return to_route('user#orderList');
}

// direct orderlist page

public function orderList()
{
    $orderList = Order::where('user_id', Auth::user()->id)
        ->groupBy('order_code')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('user.home.orderList', compact('orderList'));
}
//direct profile page
public function profile(){
    return view('user.profile.edit');
}
// Update profile
    public function updateProfile(Request $request)
    {
        $this->checkProfileValidation($request);

        $data = $this->getProfileData($request);

        if ($request->hasFile('image')) {

            if (Auth::user()->profile != null) {

                if (file_exists(public_path().'/profile/'.Auth::user()->profile)) {
                    unlink(public_path().'/profile/'.Auth::user()->profile);
                }
            }

            $fileName = uniqid().$request->file('image')->getClientOriginalName();

            $request->file('image')->move(public_path().'/profile/', $fileName);

            $data['profile'] = $fileName;

        } else {
            $data['profile'] = Auth::user()->profile;
        }

        User::where('id', Auth::user()->id)->update($data);

        Alert::success('Success!', 'Profile Updated Successfully!');

        return back();
    }

    // Get profile data
    private function getProfileData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }

    // Check profile validation
    private function checkProfileValidation($request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|min:2|max:30|unique:users,email,'.Auth::user()->id,
            'phone' => 'required|max:12',
            'address' => 'max:200',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,svg'
        ]);
    }
    //direct change password page
      public function changePasswordPage(){
        return view('user.profile.changePassword');
      }
      //change password
      //change password
public function changePassword(Request $request)
{
    // Validate all password fields
    $this->checkPasswordValidation($request);

    // Get the logged-in user's hashed password
    $userRegisterPassword = Auth::user()->password;

    // Check the old password
    if (Hash::check($request->oldPassword, $userRegisterPassword)) {

        // Update the new password
        // Auth::user()->update([
        //     'password' => Hash::make($request->newPassword)
        // ]);
        User::where('id', Auth::id())->update([
    'password' => Hash::make($request->newPassword)
]);

        Alert::success( 'Success!', 'Your password has been changed successfully!');
        return back();//to show current page
        // Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        // return redirect('/');
    } else {

        Alert::error(
            'Process Failed!',
            'Your password does not match our records!'
        );

        return back();
    }
}

   //check passwordValidation
    private function checkPasswordValidation($request){
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6|max:12',
            'confirmPassword' => 'required|min:6|max:12|same:newPassword'
        ]);
    }

    // Contact page
public function contactPage()
{
    return view('user.home.contact');
}

// Send contact message
public function contact(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'message' => 'required|string|max:2000',
    ]);

    Contact::create([
        'user_id' => Auth::id(),
        'title' => $request->title,
        'message' => $request->message,
    ]);

    Alert::success('Success!', 'Your message has been sent successfully!');

    return back();
}
//direct privay policy page
public function privacyPolicy(){
    return view('user.home.privacyPolicy');
}
//direct terms conditions page
public function termsConditions(){
    return view('user.home.termsCondition');
}

}

