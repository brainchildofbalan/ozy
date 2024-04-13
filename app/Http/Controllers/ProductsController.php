<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\CreateProductRequest;
use App\Models\ProductCategory;
use App\Models\Products;
use App\Models\ProductSubCategory;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return view('admin.products.view', compact('products'));
    }

    public function create()
    {
        $subCategories = ProductSubCategory::all();
        $products = Products::all();
        $categories = ProductCategory::all();
        return view('admin.products.products', compact('categories', 'subCategories'));
    }

    public function store(Request $request)
    {
        // Validation passed, create a new product
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'specifications' => 'required|string',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'price' => 'required|numeric|min:0',
            'quantity_in_stock' => 'required|min:0',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'related_products' => 'required',
            'star_rating' => 'required',
            'sold_out_items' => 'required',
        ], [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than :max characters.',
            // Repeat the same pattern for other fields and rules...
            'images.required' => 'Please upload at least one image.',
            'images.array' => 'The images must be an array.',
            'images.*.image' => 'Each image must be a valid image file.',
            'images.*.mimes' => 'Each image must be of type: jpeg, png, jpg, gif.',
            'images.*.max' => 'Each image must be smaller than :max kilobytes.',
        ]);


        $data['is_featured'] = $request->input('is_featured') ?? 0;
        $data['is_valuable'] = $request->input('is_valuable') ?? 0;

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Store each image in the 'public/images' directory
                $imagePath = $image->store('products', 'public');
                $imagePaths[] = $imagePath;
            }
        }
        $data['url'] = Str::slug($request->input('name'));
        $data['images'] = implode(', ', $imagePaths);
        $data['product_code'] = Uuid::uuid4()->toString();
        Products::create($data);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }



    public function edit($id)
    {
        $products = Products::findOrFail($id);

        $categories = ProductCategory::all();
        $subCategories = ProductSubCategory::all();

        return view('admin.products.edit', compact('products', 'categories', 'subCategories'));
    }



    public function update(Request $request, $id)
    {
        $category = Products::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'specifications' => 'required|string',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'price' => 'required|numeric|min:0',
            'quantity_in_stock' => 'required|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'related_products' => 'required',
            'star_rating' => 'required',
            'sold_out_items' => 'required',
            
        ], [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than :max characters.',
            // Repeat the same pattern for other fields and rules...
            'images.array' => 'The images must be an array.',
            'images.*.image' => 'Each image must be a valid image file.',
            'images.*.mimes' => 'Each image must be of type: jpeg, png, jpg, gif.',
            'images.*.max' => 'Each image must be smaller than :max kilobytes.',
        ]);


        $data['is_featured'] = $request->input('is_featured') ?? 0;
        $data['is_valuable'] = $request->input('is_valuable') ?? 0;
        // Handle image upload if needed

        $imagePathsUpdate = [];
        if ($request->hasFile('images')) {


            if ($category->images) {
                $mainimages = explode(', ', $category->images);
                foreach ($mainimages as $image) {
                    Storage::disk('public')->delete($image);
                }
            }



            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    // Store each image in the 'public/images' directory
                    $imagePath = $image->store('products', 'public');
                    $imagePathsUpdate[] = $imagePath;
                }
            }
        }


        if ($request->hasFile('images')) {
            $data['images'] = implode(', ', $imagePathsUpdate);
        } else {
            $data['images'] = $category->images;
        }


        $data['url'] = Str::slug($request->input('name'));


        // Update the category in the database
        $category->update($data);

        return redirect()->route('products.index')->with('success', 'Category updated successfully');
    }



    public function destroy($id)
    {

        $products = Products::findOrFail($id);

        // Delete the associated image from storage if it exists

        if ($products->image) {
            $mainImage = explode(', ', $products->image);
            foreach ($mainImage as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        // Delete the products from the database
        $products->delete();

        return redirect()->route('products.index')->with('success', 'Category deleted successfully');
    }
}