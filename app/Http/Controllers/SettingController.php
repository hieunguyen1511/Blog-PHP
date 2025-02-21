<?php

namespace App\Http\Controllers;

use App\Models\AdminSettings;
use App\Models\Category;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function settings() {
        return view('setting.index');
    }

    public function getAll(){
        $admin_settings = AdminSettings::all();
        return response()->json([
            'status' => '200',
            'admin_settings' => $admin_settings
        ]
        );
    }

    public function get($id){
        $admin_settings = AdminSettings::find($id);
        return response()->json([
            'status' => '200',
            'admin_settings' => $admin_settings
        ]
        );
    }


    public function create(Request $request)
    {
        try {
            // Tạo danh mục mới và lưu vào cơ sở dữ liệu
            $category = new Category();
            $category->name = $request->name;
            $category->save();

            return response()->json([
                'status' => '200',
                'message' => __('language.created_item_success')
            ]);
        } catch (\Exception $e) {
            // Xử lý lỗi nếu có
            return response()->json([
                'status' => '500',
                'message' => __('language.create_item_fail')
            ], 500);
        }
    }


    public function update(Request $request) {
        $category = Category::find($request->id);  // Lấy category theo ID
    
        if (!$category) {
            return response()->json([
                'status' => '400',
                'message' => __('language.error_no_item_selected')
            ], 400);
        }
    
        $category->name = $request->name;  // Cập nhật tên mới
        $category->save();  // Lưu thay đổi
    
        return response()->json([
            'status' => '200',
            'message' => __('language.updated_item_success')  // Thành công
        ]);
    }
    
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
