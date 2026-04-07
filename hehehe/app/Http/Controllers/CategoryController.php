<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request){
        $query = Category::query();
        if($request->has('search')){
            $query->where('name', 'like', '%'.$request->search. '%');
        }
        $categories = $query->orderBy('id', 'desc')->paginate(5);
        return view('admin.categories.index', compact('categories'));
    }

    public function create(){
        return view('admin.categories.add');
    }

    public function store(CategoryRequest $request){
        Category::create($request->validated());
        return redirect()->route('categories.index')->with('success', "Ô kê thêm thành công:>");
    }

    public function edit(Category $category){
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category){
        $category->update($request->validated());
        return redirect()->route('categories.index')->with('success', "Ô kê sửa thành công:>");
    }

    public function destroy(Category $category){
        $productCount = $category->products()->count();
        if($productCount > 0){
            return redirect()->route('categories.index')->with('error', "ko thể xóa danh mục này vì đang còn {$productCount} sản phẩm");
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', "Ô kê xóa thành công:>");
    }
}
