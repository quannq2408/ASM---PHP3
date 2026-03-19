@extends('layouts.app')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@section('title', "Danh mục sản phẩm");

@section('content')
<div class="container">
    <h2>Danh mục sản phẩm</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Thêm danh mục</a><br><br>
    <form action="{{ route('categories.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm danh mục..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Tìm kiếm</button>
        </div>
    </form>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Trạng thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category -> id }}</td>
                <td>{{ $category -> name }}</td>
                <td>{{ $category -> status ? "Hoạt Động" : "Tạm Dừng" }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" class="d-inline" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Fen cúa chắc mún xóa hông?')">Xóa<s/button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories -> links() }}
</div>
@endsection