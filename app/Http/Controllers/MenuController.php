<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\ProductCategory;
use App\Models\ServicesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Menu::all();
        return view('admin.menus.view', compact('categories'));
    }


    public function show($id)
    {
        $category = Menu::findOrFail($id);
        return view('admin.menus.show', compact('category'));
    }

    public function create()
    {
        //fetch all the products and services category.
        $productsCategory = ProductCategory::all();
        $serviceCategory = ServicesCategory::all();
        // merged array with another array ( products array with services array)
        $categoriesList = $productsCategory->concat($serviceCategory);
        return view('admin.menus.create', compact('categoriesList'));
    }

    public function store(Request $request)
    {

        //validation
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'belongs_to' => 'required',

        ], [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than :max characters.',
            'category_id.required' => 'The category ID field is required.',
            'belongs_to.required' => 'The belongs to field is required.',

        ]);

        // string to array
        // var_dump($arrayFromInput[2]);
        $arrayFromInput = explode(',', $request->input('category_id'));

        //order number and subcategory
        $data['order'] = Menu::count() + 1;
        $data['sub_categories'] = 'empty now';
        $data['url'] = $arrayFromInput[2];

        Menu::create($data);
        return redirect()->route('menus.index')->with('success', 'Category created successfully');
    }

    // Add other methods like edit, update, delete, etc.

    public function edit($id)
    {
        $category = Menu::findOrFail($id);
        //fetch all the products and services category.
        $productsCategory = ProductCategory::all();
        $serviceCategory = ServicesCategory::all();
        // merged array with another array ( products array with services array)
        $categoriesList = $productsCategory->concat($serviceCategory);

        return view('admin.menus.edit', compact('category', 'categoriesList'));
    }




    public function update(Request $request, $id)
    {
        $category = Menu::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'belongs_to' => 'required',

        ], [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than :max characters.',
            'category_id.required' => 'The category ID field is required.',
            'belongs_to.required' => 'The belongs to field is required.',

        ]);

        // string to array
        // var_dump($arrayFromInput[2]);
        $arrayFromInput = explode(',', $request->input('category_id'));

        //order number and subcategory
        $data['sub_categories'] = 'empty now';
        $data['url'] = $arrayFromInput[2];

        // Update the category in the database
        $category->update($data);

        return redirect()->route('menus.index')->with('success', 'Category updated successfully');
    }






    public function destroy($id)
    {
        $category = Menu::findOrFail($id);

        // Delete the associated image from storage if it exists
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        // Delete the category from the database
        $category->delete();

        return redirect()->route('menus.index')->with('success', 'Category deleted successfully');
    }


    public function updateOrder(Request $request)
    {
        $orderData = json_decode($request->input('orderData'), true);

        foreach ($orderData as $key => $value) {
            Menu::where('id', intval($value))->update(['order' => $key + 1]);
        }

        return response()->json(['message' => 'Order updated successfully']);
    }



    public function updateOrderGet()
    {
        $categories = Menu::orderBy('order')->get();
        return view('admin.menus.order', compact('categories'));
    }
}