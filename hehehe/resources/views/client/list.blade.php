<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - Danh sách sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('client.product.index') }}"><img src="{{ asset('images/image.png') }}" alt="" width="150px"></a>
            
            <form class="d-flex mx-auto w-50" action="{{ route('client.product.index') }}" method="GET">
                <input class="form-control me-2" type="search" name="search" placeholder="Nhập tên sản phẩm cần tìm..." value="{{ request('search') }}">
                <button class="btn btn-outline-light" type="submit">Tìm</button>
            </form>

            <div class="d-flex align-items-center">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary me-2">Đăng nhập</a>
                    <a href="/register" class="btn btn-outline-light">Đăng ký</a> 
                @endguest
                @auth
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Đăng xuất</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>
    <div class="container">        
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
                        @else
                            <img src="https://via.placeholder.com/150" class="img-fluid" alt="Chưa có ảnh">
                        @endif
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            
                            <p class="text-muted small mb-1">
                                Danh mục: <strong>{{ $product->category->name ?? 'Chưa phân loại' }}</strong>
                            </p>
                            
                            <h6 class="card-subtitle mb-3 text-danger fw-bold">
                                Giá: {{ number_format($product->price, 0, ',', '.') }} VNĐ
                            </h6>
                            
                            <div class="mt-auto">
                                <a href="{{ route('client.product.detail', $product->id) }}" class="btn btn-outline-primary w-100">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if($products->isEmpty())
            <div class="alert alert-warning text-center">
                Không tìm thấy sản phẩm nào khớp với từ khóa "{{ request('search') }}"
            </div>
        @endif
    </div>

</body>
</html>