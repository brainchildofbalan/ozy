<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Support\Str;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class ProductSubCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductSubCategory::all();
        return view('admin.sub-category.view', compact('categories'));
    }


    public function show($id)
    {
        $category = ProductSubCategory::findOrFail($id);
        return view('admin.sub-category.show', compact('category'));
    }

    public function create()
    {
        $categoriesList = ProductCategory::all();
        return view('admin.sub-category.create', compact('categoriesList'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:product_sub_categories,name',
            'relative_category_id' => 'required|',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'The category name is required.',
            'name.unique' => 'The category name must be unique.',
            'relative_category_id.required' => 'The category category id is required.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2048 kilobytes.',
        ]);

        $data['order'] = ProductSubCategory::count() + 1;
        $data['category_id'] = Uuid::uuid4()->toString();
        $data['url'] = Str::slug($request->input('name'));
        // Handle image upload if needed
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('category_images', 'public');
            $data['image'] = $imagePath;
        }

        ProductSubCategory::create($data);

        return redirect()->route('sub-categories.index')->with('success', 'Category created successfully');
    }

    // Add other methods like edit, update, delete, etc.

    public function edit($id)
    {
        $category = ProductSubCategory::findOrFail($id);
        $categoriesList = ProductCategory::all();

        return view('admin.sub-category.edit', compact('category', 'categoriesList'));
    }




    public function update(Request $request, $id)
    {
        $category = ProductSubCategory::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|unique:product_sub_categories,name,' . $id,
            'relative_category_id' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'The category name is required.',
            'name.unique' => 'The category name must be unique.',
            'relative_category_id.required' => 'The category category id is required.',
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

        return redirect()->route('sub-categories.index')->with('success', 'Category updated successfully');
    }






    public function destroy($id)
    {
        $category = ProductSubCategory::findOrFail($id);

        // Delete the associated image from storage if it exists
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        // Delete the category from the database
        $category->delete();

        return redirect()->route('sub-categories.index')->with('success', 'Category deleted successfully');
    }
}
