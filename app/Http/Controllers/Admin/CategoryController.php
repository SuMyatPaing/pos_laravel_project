<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    // Direct category list
    public function list()
    {
        $categories=Category::orderBy('created_at','desc')->paginate(5);
        return view('admin.category.list',compact('categories'));
    }

    // Create category
    public function create(Request $request)
    {
       $this->checkValidation($request);
        Category::create([
            'name' => $request->categoryName
        ]);

        // SweetAlert
        Alert::success('Saved!', 'Category created successfully!');

        // Go back to category list
        return back();
    }
//delete category
public function delete($id)
    {
        Category::where('id',$id)->delete();
        return back();
    }
    //edit category
    public function edit($id){
        $category=Category::where('id',$id)->first();
        //first() not include 0 array
        return view('admin.category.edit',compact('category'));
    }
    
    //update category
    public function update(Request $request,$id){
        $request['id']=$id;
        $this->checkValidation($request);
        Category::where('id',$id)->update([
            'name'=>$request->categoryName
        ]);
         Alert::success('Saved!', 'Category updated successfully!');
         return to_route('category#list');
        }
    
    // Check validation
private function checkValidation($request)
    {
        $request->validate([
            //categories table name column unique check
            'categoryName' => 'required|string|min:2|max:30|unique:categories,name,'.$request->id,
        ], [
            'categoryName.required' => 'အမျိုးအစားကွက်လပ်ကို ဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
            'categoryName.unique' => 'အမျိုးအစားအမည်သည် ထပ်တူဖြစ်နေပါသည်။',
        ]);
    }
}