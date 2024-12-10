<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $categories = Category::all();
            return response()->json($categories);
        }
        $categories = Category::all();
        return view('admin.category.index',compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $category = Category::create([
            'name' => $request->name,
        ]);

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Category added successfully!',
        ]);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        
        if (!$category) {
            return response()->json(['message' => 'Category not found!'], 404);
        }
        return response()->json(['status' => true, 'category' => $category],200);
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        $category = Category::find($id);
        if ($category) {
            $category->name = $request->name;
            $category->update();
            return response()->json([
                'success' => true,
                'message' => 'Category Updated successfully!',
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Category Not Found!',
        ]);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        
        if (!$category) {
            return response()->json(['message' => 'Category not found!'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted successfully!']);
    }
}
