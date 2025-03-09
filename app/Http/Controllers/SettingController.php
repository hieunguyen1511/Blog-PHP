<?php

namespace App\Http\Controllers;

use App\Models\AdminSettings;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    //Trang chủ cài đặt cho quản trị
    public function setting() {
        $setting = Setting::first();
        if (!$setting) {
            $setting = new Setting();
            $setting -> email = null;
            $setting -> password = null;
            $setting->save();
        }
        return view('setting.index')->with('email', $setting -> email)->with('hadPassword', $setting -> password != null);
    }

    //Cập nhật dữ liệu
    public function update(Request $request)
    {
        $setting = Setting::first();
        $setting->email = $request->email;
        if ($request->password != '') {
            $setting->password = Hash::make($request->password);
        }
        else {
            $setting->password = null;
        }

        try {
            $setting->update();
            return response()->json([
                'status' => '200',
                'message' => __('language.success_save_setting')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => __('language.fail_save_setting')
            ]);
        }
    }
}
