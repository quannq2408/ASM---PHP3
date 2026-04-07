@extends('admin.layouts.app')

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
                <label class="form-label">mo ta</label>
                <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Lưu</button>
        </form>
    </div>
</div>
@endsection