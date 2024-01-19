<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Share data with all views using the 'layouts.app' layout
        View::composer('front-end.layout', function ($view) {
            $product = \App\Models\ProductCategory::all();
            $services = \App\Models\ServicesCategory::all();
            $view->with([
                'product_category' => $product,
                'service_category' => $services
            ]);
        });
    }
}
