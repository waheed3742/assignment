<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('frontend.index', compact('categories'));
    }

    public function showCategoryProducts($slug)
    {
        $category = Category::where('slug', $slug)->with('products')->firstOrFail();

        return view('frontend.category_product', compact('category'));
    }

    public function showProductDetails($slug)
    {
        $product = Product::where('slug', $slug)->with('images', 'categories','comments','feedbacks')->firstOrFail();

        return view('frontend.product_details', compact('product'));
    }
}
