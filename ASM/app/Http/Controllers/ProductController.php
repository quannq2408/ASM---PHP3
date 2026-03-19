<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request) {
        $query = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->orderBy('products.id', 'desc');
        if ($request->has('search') && $request->search != '') {
            $query->where('products.name', 'like', '%' . $request->search . '%');
        }
        $products = $query->paginate(5)->appends($request->all());
        return view('products.index', compact('products'));
    }

    public function create() {
        $categories = DB::table('categories')->where('status', 1)->get();
        return view('products.add', compact('categories'));
    }

    public function store(ProductRequest $request) {
        $imagePath = '';
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/products', 'public');
        }
        DB::table('products')->insert([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'status' => (bool) $request->status,
        ]);
        return redirect()->route('products.index')->with('success', "Ô kê thêm thành công:>");
    }

    public function edit($id) {
        $product = DB::table('products')->where('id', $id)->first();
        $categories = DB::table('categories')->where('status', 1)->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, $id) {
        $product = DB::table('products')->where('id', $id)->first();
        $dataUpdate = [
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'status' => (bool) $request->status,
        ];

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $dataUpdate['image'] = $request->file('image')->store('images/products', 'public');
        }
        DB::table('products')->where('id', $id)->update($dataUpdate);
        return redirect()->route('products.index')->with('success', "Ô kê sửa thành công:>");
    }

    public function destroy($id) {
        $product = DB::table('products')->where('id', $id)->first();
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        DB::table('products')->where('id', $id)->delete();
        return redirect()->route('products.index')->with('success', "Ô kê xóa thành công:>");
    }
}