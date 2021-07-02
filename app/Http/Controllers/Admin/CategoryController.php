<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Section;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function categories(){
        Session::put('page','categories');
        $categories = Category::get();
        return view('admin.categories.categories',compact('categories'));
    }
    public function updateCategoryStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] === 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            Category::where('id',$data['category_id'])->update(['status'=>$status]);
            return response()->json([
                'status' => $status,
                'category_id'=>$data['category_id']
            ]);
        }
    }
    public function addEditCategory(Request $request,$id=null){
        if(empty($id)){
            $title ='Add Category';
        }else{
            $title = 'EDit Category';
        }
        $getSection = Section::get();
        return view('admin.categories.add_edit_category',compact('title','getSection'));
    }
}
