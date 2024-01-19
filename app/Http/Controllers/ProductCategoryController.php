<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::all();
        return view('admin.category.view', compact('categories'));
    }


    public function show($id)
    {
        $category = ProductCategory::findOrFail($id);
        return view('admin.category.show', compact('category'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:product_categories,name',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'The category name is required.',
            'name.unique' => 'The category name must be unique.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2048 kilobytes.',
        ]);

        $data['order'] = ProductCategory::count() + 1;
        $data['category_id'] = Uuid::uuid4()->toString();

        // Handle image upload if needed
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('category_images', 'public');
            $data['image'] = $imagePath;
        }
        $data['url'] = Str::slug($request->input('name'));

        ProductCategory::create($data);

        return redirect()->route('service-categories.index')->with('success', 'Category created successfully');
    }

    // Add other methods like edit, update, delete, etc.

    public function edit($id)
    {
        $category = ProductCategory::findOrFail($id);

        return view('admin.category.edit', compact('category'));
    }




    public function update(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|unique:product_categories,name,' . $id,
            'image' => 'mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'The category name is required.',
            'name.unique' => 'The category name must be unique.',
            'image.required' => 'The image file is required.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2048 kilobytes.',
        ]);

        // Handle image upload if needed
        if ($request->hasFile('image')) {
            // Delete the existing image if it exists
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            // Upload the new image
            $imagePath = $request->file('image')->store('category_images', 'public');
            $data['image'] = $imagePath;
        }

        $data['url'] = Str::slug($request->input('name'));

        // Update the category in the database
        $category->update($data);

        return redirect()->route('service-categories.index')->with('success', 'Category updated successfully');
    }






    public function destroy($id)
    {
        $category = ProductCategory::findOrFail($id);

        // Delete the associated image from storage if it exists
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        // Delete the category from the database
        $category->delete();

        return redirect()->route('service-categories.index')->with('success', 'Category deleted successfully');
    }
}