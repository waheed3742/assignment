<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Feedback;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $products = Product::with(['categories', 'images'])->get();
            return response()->json($products);
        }
        $products = Product::with(['categories', 'images'])->get();
        $categories = Category::all();
        return view('admin.product.index',compact('products','categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();
        $product = Product::create([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'description' => $validatedData['description'],
        ]);

        $product->categories()->attach($validatedData['categories']);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $manager = new ImageManager(new Driver());
                $img = $manager->read($image);
                $img = $img->resize(800,800);
                $img = $img->toJpeg(80);
                $imagePath = 'products/' . $imageName;
                $img->save(storage_path('app/public/' . $imagePath));
    
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        return response()->json(['success' => true, 'message' => 'Product created successfully']);
    }  
    public function edit($id)
    {
        $product = Product::with(['categories', 'images'])->find($id);
    
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }
        $categories = Category::all();
    
        return response()->json([
            'success' => true,
            'product' => $product,
            'categories' => $categories,
        ]);
    }
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        $product->categories()->sync($request->categories);

        if ($request->hasFile('images')) {

            $product->images->each(function ($image) {
                Storage::delete('public/' . $image->image_path);
                $image->delete();
            });

            foreach ($request->file('images') as $image) {
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

                $manager = new ImageManager(new Driver());
                $img = $manager->read($image);
                $img->resize(800, 800);
                $img = $img->toJpeg(80);

                $imagePath = 'products/' . $imageName;

                $img->save(storage_path('app/public/' . $imagePath));

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        return response()->json(['success' => true, 'message' => 'Product updated successfully']);
    }
    public function destroy($productId)
    {
        $product = Product::with(['categories', 'images'])->find($productId);
        
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }
    
        $product->categories()->detach();
    
        foreach ($product->images as $image) {
            $image->delete();
    
            $imagePath = storage_path('app/public/' . $image->image_path);
            if (file_exists($imagePath)) {
                Storage::delete('public/' . $image->image_path);
            }
        }
    
        $product->delete();
    
        return response()->json(['success' => true, 'message' => 'Product deleted successfully']);
    }

    public function storeComment(Request $request, $slug)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);
        $product = Product::where('slug',$slug)->firstOrFail();
        if ($product) {
            $comment = new Comment();
            $comment->product_id = $product->id;
            $comment->user_id = Auth::id();
            $comment->comment = $request->comment;
            $comment->save();
    
            return redirect()->route('product.details', $product->slug)->with('success', 'Comment added successfully');
        }
         return redirect()->route('product.details', $product->slug)->with('error', 'Product Not Found');

    }
    public function storeFeedback(Request $request, $slug)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:500',
        ]);
        $product = Product::where('slug',$slug)->firstOrFail();
        if ($product) {
            $feedback = new Feedback();
            $feedback->product_id = $product->id;
            $feedback->user_id = Auth::id();
            $feedback->rating = $request->rating;
            $feedback->feedback = $request->feedback;
            $feedback->save();
    
            return redirect()->route('product.details', $product->slug)->with('success', 'Feedback submitted successfully');
        }
        return redirect()->route('product.details', $product->slug)->with('error', 'Product Not Found');

    }
}
