<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductFeedbackController extends Controller
{
    public function storeFeedback(Request $request, $slug)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:500',
        ]);

        $product = Product::where('slug', $slug)->firstOrFail();

        Feedback::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'feedback' => $request->feedback,
        ]);

        return redirect()->route('product.details', $product->slug)->with('success', 'Feedback submitted successfully');
    }
}
