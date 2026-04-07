@extends('admin.layouts.app')

@section('title', "Thêm sản phẩm")

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Thêm sản phẩm mới</h2>
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

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Giá</label>
                <input type="number" name="price" class="form-control" value="{{ old('price') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Số lượng</label>
                <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Danh mục</label>
                <select name="category_id" class="form-control">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach($categories as $cate)
                        <option value="{{ $cate->id }}" {{ old('category_id') == $cate->id ? 'selected' : '' }}>
                            {{ $cate->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Ảnh sản phẩm</label>
                <input type="file" name="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Thêm mới</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection