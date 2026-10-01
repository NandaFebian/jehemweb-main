<?php

namespace App\Providers;

use App\Models\Product;
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
    public function boot(): void
    {
        // The footer on every public page links to the latest products.
        View::composer('components.footer', function ($view) {
            $view->with('footerProducts', Product::query()->published()->latest()->limit(5)->get(['id', 'name']));
        });
    }
}
