<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request) {
        $query = Product::with('category');
        if($request->has('search')){
            $query->where('name', 'like', '%'.$request->search. '%');
        }
        $products = $query->paginate(5); 
        
        if ($request->is('admin/*')) {
            return view('admin.products.index', compact('products')); 
        }
        return view('client.list', compact('products'));
    }

    public function create() {
        $categories = Category::all();
        return view('admin.products.add', compact('categories'));
    }

    public function store(ProductRequest $request) {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
             $data['image'] = $request->file('image')->store('images/products', 'public');
        }
        
        Product::create($data); 
        return redirect()->route('products.index')->with('success', "Ô kê thêm thành công:>");
    }

    public function edit(Product $product) {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, Product $product) {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('images/products', 'public');
        }

        $product->update($data);
        return redirect()->route('products.index')->with('success', "Ô kê sửa thành công:>");
    }

    public function destroy(Product $product) {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', "Ô kê xóa thành công:>");
    }

    public function showDetail($id){
        $product = Product::with('category')->findOrFail($id);
        return view('client.detail', compact('product'));
    }
}