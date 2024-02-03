<?php

namespace App\Http\Controllers;

use App\Models\Services;
use App\Models\ServicesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class ServicesController extends Controller
{
    public function index()
    {
        $categories = Services::all();
        return view('admin.services.view', compact('categories'));
    }


    public function show($id)
    {
        $category = Services::findOrFail($id);
        return view('admin.services.show', compact('category'));
    }

    public function create()
    {
        $categories = ServicesCategory::all();
        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'thumb_description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'category_id' => 'required',
            'relative_products' => 'required',

        ], [
            'name.required' => 'The :attribute field is required.',
            'name.string' => 'The :attribute must be a string.',
            'name.max' => 'The :attribute must not exceed 255 characters.',

            'description.required' => 'The :attribute field is required.',
            'description.string' => 'The :attribute must be a string.',

            'thumb_description.required' => 'The :attribute field is required.',
            'thumb_description.string' => 'The :attribute must be a string.',

            'image.required' => 'The :attribute field is required.',
            'image.image' => 'The :attribute must be an image file.',
            'image.mimes' => 'The :attribute must be of type jpeg, png, jpg, or gif.',

            'category_id.required' => 'The :attribute field is required.',

            'relative_products.required' => 'The :attribute field is required.',

        ]);

        $data['order'] = Services::count() + 1;
        $data['is_home'] = $request->input('is_home') ?? 0;

        // Handle image upload if needed
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('services_images', 'public');
            $data['image'] = $imagePath;
            echo $imagePath;
        }
        $data['url'] = Str::slug($request->input('name'));
        $data['updated_by'] = Str::slug($request->input('name'));
        $data['service_id'] = Uuid::uuid4()->toString();
        Services::create($data);

        return redirect()->route('services.index')->with('success', 'Category created successfully');
    }

    // Add other methods like edit, update, delete, etc.

    public function edit($id)
    {
        $category = Services::findOrFail($id);
        $categories = ServicesCategory::all();

        return view('admin.services.edit', compact('category', 'categories'));
    }




    public function update(Request $request, $id)
    {
        $category = Services::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'thumb_description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
            'category_id' => 'required',
            'relative_products' => 'required',
        ], [
            'name.required' => 'The :attribute field is required.',
            'name.string' => 'The :attribute must be a string.',
            'name.max' => 'The :attribute must not exceed 255 characters.',

            'description.required' => 'The :attribute field is required.',
            'description.string' => 'The :attribute must be a string.',

            'thumb_description.required' => 'The :attribute field is required.',
            'thumb_description.string' => 'The :attribute must be a string.',

            'image.image' => 'The :attribute must be an image file.',
            'image.mimes' => 'The :attribute must be of type jpeg, png, jpg, or gif.',

            'category_id.required' => 'The :attribute field is required.',

            'relative_products.required' => 'The :attribute field is required.',

        ]);

        $data['is_home'] = $request->input('is_home') ?? 0;

        // Handle image upload if needed
        if ($request->hasFile('image')) {
            // Delete the existing image if it exists
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            // Upload the new image
            $imagePath = $request->file('image')->store('services_images]\]', 'public');
            $data['image'] = $imagePath;
        }

        $data['url'] = Str::slug($request->input('name'));
        $data['updated_by'] = Str::slug($request->input('name'));
        // Update the category in the database
        $category->update($data);

        return redirect()->route('services.index')->with('success', 'Category updated successfully');
    }






    public function destroy($id)
    {
        $category = Services::findOrFail($id);

        // Delete the associated image from storage if it exists
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        // Delete the category from the database
        $category->delete();

        return redirect()->route('services.index')->with('success', 'Category deleted successfully');
    }
}
