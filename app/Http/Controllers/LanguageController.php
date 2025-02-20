<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request)
    {
        $locale = $request->locale;
        App::setLocale($locale);
        $this->setEnvValue('APP_LOCALE', $locale);
        return response()->json([
            'status' => '200',
        ]);
    }

    // Hàm thay đổi giá trị trong file .env
    private function setEnvValue($key, $value)
    {
        $envPath = base_path('.env');

        if (File::exists($envPath)) {
            // Đọc nội dung file .env
            $env = File::get($envPath);

            // Tìm dòng chứa key và thay đổi giá trị
            $pattern = "/^{$key}=.*/m";
            $replacement = "{$key}={$value}";

            if (preg_match($pattern, $env)) {
                // Nếu key đã tồn tại, thay thế giá trị
                $env = preg_replace($pattern, $replacement, $env);
            } else {
                // Nếu key chưa tồn tại, thêm mới
                $env .= "\n{$key}={$value}\n";
            }

            // Ghi lại file .env
            File::put($envPath, $env);

            // Clear cache để config mới có hiệu lực
            Artisan::call('config:clear');
        }
    }

}
