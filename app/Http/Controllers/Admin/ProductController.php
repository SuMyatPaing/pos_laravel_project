<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
class ProductController extends Controller
{
    //create page
    public function createPage(){
        $categories=Category::select('id','name')->get();
        return view('admin.product.create', compact('categories'));
    }
    //product list
    public function list($action="default data"){
        $products=Product::select('products.id','products.image','products.name','products.price','products.stock','products.category_id','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->when($action == 'lowAmt',function($query){
            $query->where('products.stock','<=',5);
        })
        ->when(request('searchKey'),function($query){
            $query->whereAny(['products.name','products.price','categories.name'],'like','%'.request('searchKey').'%');
        })
        ->orderBy('products.created_at','desc')
        ->get();
        return view('admin.product.productList',compact('products'));
    }

//edit product
public function edit($id){
    $categories=Category::get();
    $product=Product::where('id',$id)->first();
    return view('admin.product.edit',compact('product','categories'));
}
//view detail product
public function detail($id)
{
    $product = Product::select(
        'products.*',
        'categories.name as category_name'
    )
        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
        ->where('products.id', $id)
        ->firstOrFail();

    return view('admin.product.detail', compact('product'));
}

//delete product
public function delete($id){
    Product::where('id',$id)->delete();
    return back();
}



    //create product
    public function create(Request $request){
        $this->checkValidation($request,"create");
        $data=$this->getData($request);
        if($request->hasFile('image')){
            $fileName=uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/productImage/',$fileName);
            $data['image']=$fileName;
        }
        Product::create($data);
         Alert::success('Saved!', 'Product created successfully!');
        return back();
    }



    //update product
public function update(Request $request){
    // dd($request->all());
    $this->checkValidation($request,'update');
    $data=$this->getData($request);
    if($request->hasFile('image')){
        $oldImageName=$request->productImage;
        if(file_exists(public_path('productImage/'.$oldImageName))){
            unlink(public_path('productImage/'.$oldImageName));
        }
     $fileName=uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/productImage/',$fileName);
            $data['image']=$fileName;

    }else{
          $data['image']=$request->productImage;

    }

    Product::where('id',$request->productId)->update($data);
      Alert::success('Saved!', 'Product updated successfully!');
        return to_route('product#list');
}




        private function getData($request){

            return [
                // 'image'=>$request->image,
                'name'=>$request->name,
                'category_id'=>$request->categoryId,
                'price'=>$request->price,
                'stock'=>$request->stock,
                'description'=>$request->description
            ];
        }

        //checkValidation
private function checkValidation($request,$action){
   $rules=[
    // 'image' =>'required|file|mimes:jpg,jpeg,png,webp,svg,gif',
     'name' =>'required|min:2|max:30|unique:products,name,'.$request->productId,
      'categoryId' =>'required',
       'price' =>'required|numeric|min:2,',
        'stock' =>'required|numeric|min:1',
         'description' =>'required|max:2000|string',
   ];
   $rules['image'] = $action =='create' ? 'required|file|mimes:jpg,jpeg,png,webp,svg,gif' :   'file|mimes:jpg,jpeg,png,webp,svg,gif';
   $message=[];
   $request->validate($rules,$message);
}

}


