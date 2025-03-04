<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //trang chủ cho quản trị (bảng dữ liệu)
    public function index() {
        return view('category.index');
    }

    //API lấy bảng dữ liệu
    public function getAll(){
        $categories = Category::all();
        return response()->json([
            'status' => '200',
            'categories' => $categories
        ]
        );
    }

    //API lấy dữ liệu cụ thể
    public function get($id){
        $category = Category::find($id);
        return response()->json([
            'status' => '200',
            'category' => $category
        ]
        );
    }

    //Tạo mới dữ liệu
    public function create(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->link = Str::slug($request->name);
        try {
            $category->save();

            return response()->json([
                'status' => '200',
                'message' => __('language.created_item_success')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => __('language.create_item_fail')
            ], 500);
        }
    }


    //Cập nhật dữ liệu
    public function update(Request $request) {
        $category = Category::find($request->id);
    
        if (!$category) {
            return response()->json([
                'status' => '400',
                'message' => __('language.error_no_item_selected')
            ], 400);
        }
    
        $category->name = $request->name;
        
        try {
            $category->save();
            return response()->json([
                'status' => '200',
                'message' => __('language.updated_item_success')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => __('language.update_item_fail')
            ], 500);
        }
    }
    
    //Xóa 1 dòng dữ liệu
    public function delete(Request $request)
    {
        $category = Category::find($request->id);

        if (!$category) {
            return response()->json([
                'status' => '400',
                'message' => __('language.error_no_item_selected')
            ], 400);
        }

        try {
            $category->delete();
            return response()->json([
                'status' => '200',
                'message' => __('language.deleted_item_success')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => __('language.delete_item_fail')
            ], 500);
        }
    }

    //Xóa nhiều dòng dữ liệu
    public function deleteItems(Request $request)
    {
        if (!isset($request->ids) || count($request->ids) === 0) {
            return response()->json([
                'status' => '400',
                'message' => __('language.error_no_item_selected')
            ], 400);
        }

        try {
            Category::whereIn('id', $request->ids)->delete();

            return response()->json([
                'status' => '200',
                'message' => __('language.deleted_items_success')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => __('language.delete_items_fail')
            ], 500);
        }
    }

}
