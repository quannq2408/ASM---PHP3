@extends('layouts.app')

@section('title', "Sửa sản phẩm")

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Sửa sản phẩm</h2>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Giá</label>
                <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Số lượng</label>
                <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Danh mục</label>
                <select name="category_id" class="form-control">
                    @foreach($categories as $cate)
                        <option value="{{ $cate->id }}" {{ $product->category_id == $cate->id ? 'selected' : '' }}>
                            {{ $cate->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Ảnh hiện tại</label><br>
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" width="150" alt="Ảnh SP" class="img-thumbnail">
                @else
                    <span class="text-danger">Chưa có ảnh</span>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Đổi ảnh mới (Bỏ trống nếu giữ nguyên ảnh cũ)</label>
                <input type="file" name="image" class="form-control">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Tạm dừng</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Lưu thay đổi</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection