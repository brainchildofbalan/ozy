<?php

namespace App\Http\Controllers;

use App\Models\ServicesCategory;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class TestimonialController extends Controller
{
    public function index()
    {
        $categories = Testimonial::all();
        return view('admin.testimonials.view', compact('categories'));
    }


    public function show($id)
    {
        $category = Testimonial::findOrFail($id);
        return view('admin.testimonials.show', compact('category'));
    }

    public function create()
    {
        $categories = ServicesCategory::all();
        return view('admin.testimonials.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'star' => 'required|integer|min:1|max:5',
            'description' => 'required|string',
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
        ], [
            'star.required' => 'Please provide a star rating.',
            'star.integer' => 'The star rating must be an integer.',
            'star.min' => 'The star rating must be at least 1.',
            'star.max' => 'The star rating cannot be greater than 5.',
            'description.required' => 'Please provide a description.',
            'description.string' => 'The description must be a string.',
            'name.required' => 'Please provide a name.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'designation.required' => 'Please provide a designation.',
            'designation.string' => 'The designation must be a string.',
            'designation.max' => 'The designation may not be greater than 255 characters.',
        ]);

        $data['is_home'] = $request->input('is_home') ?? 0;

        $data['updated_by'] = Str::slug($request->input('name'));
        Testimonial::create($data);
        return redirect()->route('testimonials.index')->with('success', 'Category created successfully');
    }

    // Add other methods like edit, update, delete, etc.

    public function edit($id)
    {
        $category = Testimonial::findOrFail($id);
        $categories = ServicesCategory::all();

        return view('admin.testimonials.edit', compact('category', 'categories'));
    }




    public function update(Request $request, $id)
    {
        $category = Testimonial::findOrFail($id);

        $data = $request->validate([
            'star' => 'required|integer|min:1|max:5',
            'description' => 'required|string',
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
        ], [
            'star.required' => 'Please provide a star rating.',
            'star.integer' => 'The star rating must be an integer.',
            'star.min' => 'The star rating must be at least 1.',
            'star.max' => 'The star rating cannot be greater than 5.',
            'description.required' => 'Please provide a description.',
            'description.string' => 'The description must be a string.',
            'name.required' => 'Please provide a name.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'designation.required' => 'Please provide a designation.',
            'designation.string' => 'The designation must be a string.',
            'designation.max' => 'The designation may not be greater than 255 characters.',
        ]);

        $data['is_home'] = $request->input('is_home') ?? 0;



        // Update the category in the database
        $category->update($data);

        return redirect()->route('testimonials.index')->with('success', 'Category updated successfully');
    }






    public function destroy($id)
    {
        $category = Testimonial::findOrFail($id);

        // Delete the category from the database
        $category->delete();

        return redirect()->route('testimonials.index')->with('success', 'Category deleted successfully');
    }
}
