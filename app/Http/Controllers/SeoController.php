<?php

namespace App\Http\Controllers;

use App\Models\Seo;
use App\Models\ServicesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class SeoController extends Controller
{
    public function index()
    {
        $categories = Seo::all();
        return view('admin.seo.view', compact('categories'));
    }


    public function show($id)
    {
        $category = Seo::findOrFail($id);
        return view('admin.seo.show', compact('category'));
    }

    public function create()
    {
        $categories = ServicesCategory::all();
        return view('admin.seo.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'keywords' => 'required|string',
            'author' => 'nullable|string|max:255',
            'url' => 'nullable|url',
            'canonical_url' => 'nullable|url',
            'type' => 'nullable|string|max:255',
            'locale' => 'nullable|string|max:10',
            'site_name' => 'nullable|string|max:255',
            'twitter_site' => 'nullable|string|max:255',
            'twitter_creator' => 'nullable|string|max:255',
            'og_type' => 'nullable|string|max:255',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'mimes:jpeg,png,jpg,gif|max:2048',
            'og_url' => 'nullable|url',
            'og_locale' => 'nullable|string|max:10',
            'og_site_name' => 'nullable|string|max:255',
        ], [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than :max characters.',
            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a string.',
            'keywords.required' => 'The keywords field is required.',
            'keywords.string' => 'The keywords must be a string.',
            // Add more custom error messages for each field
        ]);

        $data['is_home'] = $request->input('is_home') ?? 0;

        // Handle image upload if needed
        if ($request->hasFile('og_image')) {
            $imagePath = $request->file('og_image')->store('seo_images', 'public');
            $data['image'] = $imagePath;
        }

        $data['updated_by'] = Str::slug($request->input('name'));
        Seo::create($data);
        return redirect()->route('seo.index')->with('success', 'Category created successfully');
    }

    // Add other methods like edit, update, delete, etc.

    public function edit($id)
    {
        $category = Seo::findOrFail($id);
        $categories = ServicesCategory::all();

        return view('admin.seo.edit', compact('category', 'categories'));
    }




    public function update(Request $request, $id)
    {
        $category = Seo::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'keywords' => 'required|string',
            'author' => 'nullable|string|max:255',
            'url' => 'nullable|url',
            'canonical_url' => 'nullable|url',
            'type' => 'nullable|string|max:255',
            'locale' => 'nullable|string|max:10',
            'site_name' => 'nullable|string|max:255',
            'twitter_site' => 'nullable|string|max:255',
            'twitter_creator' => 'nullable|string|max:255',
            'og_type' => 'nullable|string|max:255',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'og_url' => 'nullable|url',
            'og_locale' => 'nullable|string|max:10',
            'og_site_name' => 'nullable|string|max:255',
        ], [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than :max characters.',
            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a string.',
            'keywords.required' => 'The keywords field is required.',
            'keywords.string' => 'The keywords must be a string.',
            // Add more custom error messages for each field
        ]);

        $data['is_home'] = $request->input('is_home') ?? 0;



        // Update the category in the database
        $category->update($data);

        return redirect()->route('seo.index')->with('success', 'Category updated successfully');
    }






    public function destroy($id)
    {
        $category = Seo::findOrFail($id);

        // Delete the category from the database
        $category->delete();

        return redirect()->route('seo.index')->with('success', 'Category deleted successfully');
    }
}