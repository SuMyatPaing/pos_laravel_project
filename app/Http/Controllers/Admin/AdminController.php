<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    //direct admin dashboard
    public function dashboard(){
        $totalSaleAmt=PaymentHistory::sum('total_amt');
        $orderCount=Order::whereIn('status',[0,1])->count('id');
        $pendingCount=Order::where('status',[0])->count('id');
        $registerUser=User::where('role','user')->count('id');
        return view('admin.dashboard.main',compact('totalSaleAmt','orderCount','registerUser','pendingCount'));
    }
    //create new admin page
    public function createAdminPage(){
      return view('admin.account.newAdmin');

    }
    //add new admin account
    public function createAdmin(Request $request){
        $this->checkAccountValidtion($request);
        User::create([
            'name' =>$request->name,
            'email' =>$request->email,
             'password' =>Hash::make($request->password),

             'role' =>'admin',
             'created_at' =>Carbon::now(),
               'updated_at' =>Carbon::now(),
        ]);
         Alert::success('Saved!', 'New Admin created successfully!');
        return back();
    }


    //admin list
     public function adminList(){
        $admin=User::select('id','name','nickname','email','address','phone','profile','created_at','role','provider')
        // ->orWhere('role','admin')
        // ->orWhere('role','superadmin')
        //(admin || superadmin) && searchKey
        ->whereIn('role',['admin','superadmin'])
        ->when(request('searchKey'),function($query){
        $query->whereAny(['name','email','address','phone','provider','role'],'like','%'.request('searchKey').'%');
        })
        ->paginate(4);


          return view('admin.account.adminList',compact('admin'));
    }
    //user list
    public function userList()
{
    $user = User::select(
        'id',
        'name',
        'nickname',
        'email',
        'address',
        'phone',
        'profile',
        'created_at',
        'role',
        'provider'
    )
    ->where('role', 'user')
    ->when(request('searchKey'), function ($query) {
        $query->whereAny(
            ['name', 'email', 'address', 'phone', 'provider', 'role'],
            'like',
            '%' . request('searchKey') . '%'
        );
    })
    ->paginate(4);

    return view('admin.account.userList', compact('user'));
}

 //delete admin
    public function userDelete($id){
        User::where('id',$id)->delete();
        return back();

    }


    //delete admin
    public function adminDelete($id){
        User::where('id',$id)->delete();
        return back();

    }



    //check account validation
    private function checkAccountValidtion($request){
        $request->validate([
            'name'=>'required',
             'email'=>'required|unique:users,email',
              'password'=>'required|min:6|max:12',
               'confirmPassword'=>'required|min:6|max:12|same:password',

        ]);

    }

}
