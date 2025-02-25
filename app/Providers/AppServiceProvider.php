<?php

namespace App\Providers;

use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        try {
            
            $categories = Category::all();
            View::share('categories', $categories);
        }
        catch (\Exception $e) {
            
        }
    }
}


