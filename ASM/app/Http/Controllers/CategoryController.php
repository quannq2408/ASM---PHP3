<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request){
        //dạng query builder 
        $query = DB::table('categories')->orderBy('id', 'desc');
        if ($request->has('search') && $request->search != '') {
        $query->where('name', 'like', '%' . $request->search . '%');
        }
        $categories = $query->paginate(5);
        return view('categories.index', compact('categories'));
    }

    public function create(){
        return view('categories.add');
    }

    public function store(CategoryRequest $request){
        DB::table('categories')->insert([
            'name' => $request->name,
            'status' => (bool) $request->status,
        ]);
        return redirect()->route('categories.index')->with('success', "Ô kê thêm thành công:>");
    }

    public function edit($id){
        $category = DB::table('categories')->where('id', $id)->first();
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id){
        DB::table('categories')->where('id',$id)->update([
            'name' => $request->name,
            'status'=>(bool) $request->status,
        ]);
        return redirect()->route('categories.index')->with('success', "Ô kê sửa thành công:>");
    }

    public function destroy($id){
        $productCount = DB::table('products')->where('category_id', $id)->count();
        if ($productCount > 0) {
            return redirect()->route('categories.index')
                ->with('error', "Âyy ko xóa đc nhá, danh mục ni còn {$productCount} sản phẩm đớ");
        }
        DB::table('categories')->where('id', $id)->delete();
        return redirect()->route('categories.index')->with('success', "Ô kê xóa thành công:>");
    }
}
