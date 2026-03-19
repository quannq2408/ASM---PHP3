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

@section('title', "Sửa danh mục");

@section('content')
<div class="card">
    <h2>Sửa danh mục</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Sửa danh mục</a>
    <div class="card-body">
        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Tên</label>
                <input type="text" name="name" class="form-control" value="{{$category->name}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="status">
                    <option value="1" {{$category->status == 1 ? 'selected' : ''}}>Hoạt động</option>
                    <option value="0" {{$category->status == 0 ? 'selected' : ''}}>Tạm dừng</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Lưu</button>
        </form>
    </div>
</div>
@endsection