<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
    // Para newest lagi nasa huli
        $products = Product::with('category')
                    ->orderBy('id', 'asc') // ascending
                    ->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('products.create', compact('categories'));
    }

    // ✅ Store product
    public function store(Request $request)
    {
        $request->validate([
            'category_id'=>'required|exists:categories,id',
            'name'=>'required|string|max:255',
            'purchase_price'=>'required|numeric|min:0',
            'sale_price'=>'required|numeric|min:0',
            'stock'=>'required|integer|min:0',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('category_id','name','purchase_price','sale_price','stock');

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public'); 
            $data['image'] = $path;
        }

        Product::create($data);

        // ✅ balik sa list with success message
        return redirect()->route('products.index')->with('success','Product added successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('products.edit', compact('product','categories'));
    }

    // ✅ Update product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id'=>'required|exists:categories,id',
            'name'=>'required|string|max:255',
            'purchase_price'=>'required|numeric|min:0',
            'sale_price'=>'required|numeric|min:0',
            'stock'=>'required|integer|min:0',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('category_id','name','purchase_price','sale_price','stock');

        // Handle image upload (replace only if new image is uploaded)
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        } else {
            $data['image'] = $product->image; // keep old image
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success','Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted successfully!');
    }
}
