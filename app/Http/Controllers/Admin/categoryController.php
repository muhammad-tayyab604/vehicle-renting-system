<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;


class categoryController extends Controller
{
    public function categoryIndex()
    {
        $categories = Category::get();
        return view('AdminPanel.Categories.index', compact('categories'));
    }
    // Category form show

    public function addCategoryForm()
    {
        return view('AdminPanel.Categories.store');
    }
    // Add category
    public function categoryStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('Failed', 'Vehicle is not added, Please Retry with correct information');
        }
        $requestData = [
            'name' => $request->name,
        ];
        Category::create($requestData);
        return redirect()->back()->with('success', 'Category Added successfully!');
    }


    public function categoryEdit($id)
    {
        $category = Category::findOrFail($id);
        return view('AdminPanel.Categories.edit', compact('category'));
    }
    public function categoryUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);
        $category = Category::findOrFail($id);
        if ($validator->fails()) {
            return redirect()->back()->with('Failed', 'Vehicle is not added, Please Retry with correct information');
        }
        $requestData = [
            'name' => $request->name,
        ];
        $category->update($requestData);
        return redirect()->back()->with('success', 'Category Updated successfully!');
    }


    // category delete
    public function categoryDelete($id)
    {
        try {
            $vehicle = Category::findOrFail($id);
            $vehicle->delete();
            return redirect()->back()->with('success', 'Category Deleted successfully!');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the category.');
        }
    }
}
