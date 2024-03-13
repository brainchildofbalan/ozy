<?php

namespace App\Jobs;

use App\Models\Products;
use App\Models\Seo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveProductToSeo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Retrieve products from the database
        $products = Products::all();

        // Iterate through each product and save SEO data
        foreach ($products as $product) {
            // Create a new SEO record
            $seo = new Seo();
            $seo->title = $product->name;
            $seo->keywords = $product->name;
            $seo->description = strip_tags($product->description);
            $seo->url = $product->url; // Assuming 'url' is a field in the products table
            // Add other fields if necessary
            $seo->save();
        }
    }
}
