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
            $seoData = new \stdClass();;
            $currentUrl = request()->url();
            $lastPart = basename($currentUrl);

            $seo = \App\Models\Seo::where('url', $currentUrl)->first();
            $products = \App\Models\Products::where('url', $lastPart)->first();
            $services = \App\Models\Services::where('url', $lastPart)->first();
            if (empty($seo)) {
                if (!empty($products)) {
                    $seoData->title =  $products->name;
                    $seoData->description =  $products->description;
                    $seoData->keywords =  $products->keywords;
                } elseif (!empty($services)) {
                    $seoData->title =  $services->name;
                    $seoData->description =  $services->description;
                    $seoData->keywords =  $services->keywords;
                }
            } else {
                $seoData = $seo;
            }






            // dd($seoData);





            $product = \App\Models\ProductCategory::all();
            $services = \App\Models\ServicesCategory::all();

            $view->with([
                'product_category' => $product,
                'service_category' => $services,
                'seo' => $seoData,
            ]);
        });
    }
}
