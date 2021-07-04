<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Section;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function categories()
    {
        Session::put('page', 'categories');
        $categories = Category::with('section', 'parentcategory')->get();
        // $categories = Category::with(['section'=>function($query){
        //     $query->select('id','name');
        // }])->get();
        // $categories = json_decode(json_encode($categories));
        // echo "<pre>".print_r($categories,true)."</pre>";die;
        return view('admin.categories.categories', compact('categories'));
    }
    public function updateCategoryStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] === 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json([
                'status' => $status,
                'category_id' => $data['category_id']
            ]);
        }
    }
    public function addEditCategory(Request $request, $id = null)
    {
        if (empty($id)) {
            $title = 'Add Category';
            $categorydata = array();
            $getCategories = array();
            if ($request->isMethod('POST')) {
                $request->validate([
                    'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'section_id' => 'required',
                    'parent_id' => 'required',
                    'category_image' => 'required',
                    'url' => 'required',
                ], [
                    'category_name.required' => 'Name is required',
                    'category_name.regex' => 'Name is valid',
                    'section_id.required' => 'Section is required',
                    'parent_id.required' => 'Parent category is required',
                    'url.required' => 'Category URL is required',
                    'category_image.required' => 'Image is required',
                ]);
                $data = $request->all();
                $category = new Category();
                // Upload Image
                if ($request->hasFile('category_image')) {
                    $file = $request->file('category_image');
                    if ($file->isValid()) {
                        ## get image extension
                        $extension = $file->getClientOriginalExtension();
                        ## generate new image name
                        $imgName = time() . uniqid() . '.' . $extension;
                        $imgPath = 'images/category_images/' . $imgName;
                        Image::make($file)->save($imgPath);
                        // save database
                        $category->category_image = $imgName;
                    }
                }
                if (empty($request->description)) {
                    $data['description'] = '';
                }
                if (empty($request->category_discount)) {
                    $data['category_discount'] = '';
                }
                if (empty($request->meta_title)) {
                    $data['meta_title'] = '';
                }
                if (empty($request->meta_description)) {
                    $data['meta_description'] = '';
                }
                if (empty($request->meta_keywords)) {
                    $data['meta_keywords'] = '';
                }
                $category->parent_id = $data['parent_id'];
                $category->section_id = $data['section_id'];
                $category->category_name = $data['category_name'];
                $category->category_discount = $data['category_discount'];
                $category->description = $data['description'];
                $category->url = $data['url'];
                $category->meta_title = $data['meta_title'];
                $category->meta_description = $data['meta_description'];
                $category->meta_keywords = $data['meta_keywords'];
                $category->status = 1;
                $category->save();
                return redirect('/admin/categories')->with('success', 'category add success!');
            }
        } else {
            $title = 'Edit Category';
            $categorydata = Category::where('id', $id)->first();
            // for append category level
            $getCategories = Category::with('subCategories')->where(['parent_id'=>0,'section_id'=>$categorydata->section_id])->get();
            // $getCategories = json_decode(json_encode($getCategories));
            // echo "<pre>" . print_r($getCategories, true) . "</pre>";
            // die;
        }
        $getSection = Section::get();
        return view('admin.categories.add_edit_category', compact('title', 'getSection','categorydata','getCategories'));
    }
    ## append categories level
    public function appendCategoriesLevel(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $getCategories = Category::with('subCategories')->where(['section_id' => $data['section_id'], 'parent_id' => 0, 'status' => 1])->get();

            return view('admin.categories.append_categories_level', compact('getCategories'));
        }
    }
}
