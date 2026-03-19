@extends('layouts.app')
@section('title', "Quản lý sản phẩm")
@section('content')
<div class="container">
    <h2>Quản lý sản phẩm</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Thêm sản phẩm</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('products.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm sản phẩm..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Tìm kiếm</button>
        </div>
    </form>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ảnh</th>
                <th>Tên SP</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $pro)
            <tr>
                <td>{{ $pro->id }}</td>
                <td>
                    @if($pro->image)
                        <img src="{{ asset('storage/' . $pro->image) }}" width="80" alt="{{ $pro->name }}">
                    @else
                        <span>Chưa có ảnh</span>
                    @endif
                </td>
                <td>{{ $pro->name }}</td>
                <td>{{ number_format($pro->price) }} đ</td>
                <td>{{ $pro->quantity }}</td>
                <td>{{ $pro->category_name }}</td>
                <td>
                    <a href="{{ route('products.edit', $pro->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('products.destroy', $pro->id) }}" method="POST" class="d-inline">
                        @csrf @method("DELETE")
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
</div>
@endsection