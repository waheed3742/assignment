<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCommentController extends Controller
{
    public function storeComment(Request $request, $slug)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $product = Product::where('slug', $slug)->firstOrFail();

        Comment::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('product.details', $product->slug)->with('success', 'Comment added successfully');
    }
}
