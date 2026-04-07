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

@section('title', "them danh muc");

@section('content')
<div class="card">
    <h2>them danh muc</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">them danh muc</a>
    <div class="card-body">
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">ten danh muc</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">mo ta</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">them moi</button>
        </form>
    </div>
</div>
@endsection