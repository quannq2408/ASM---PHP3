<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm - {{ $product->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5 mb-5">
        <div class="card shadow-sm p-4">
            <div class="row">
                
                <div class="col-md-5 text-center mb-4 mb-md-0">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded shadow-sm" alt="{{ $product->name }}" style="max-height: 400px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/400x400?text=No+Image" class="img-fluid rounded shadow-sm" alt="Chưa có ảnh">
                    @endif
                </div>

                <div class="col-md-7">
                    <h2 class="fw-bold mb-3">{{ $product->name }}</h2>
                    
                    <p class="text-muted mb-2">
                        Danh mục: <span class="badge bg-info text-dark">{{ $product->category->name ?? 'Không xác định' }}</span>
                    </p>
                    
                    <h3 class="text-danger fw-bold mb-4">{{ number_format($product->price) }} đ</h3>

                    <div class="mb-3">
                        <p class="mb-1"><strong>Số lượng trong kho:</strong> {{ $product->quantity }}</p>
                    </div>

                    <hr>

                    <h5 class="fw-bold">Mô tả sản phẩm</h5>
                    <p style="line-height: 1.6;">{{ $product->description }}</p>

                    <div class="mt-4">
                        <button class="btn btn-primary btn-lg px-4 me-2">Thêm vào giỏ hàng</button>
                        <a href="{{ route('client.product.index') }}" class="btn btn-outline-secondary btn-lg px-4">Quay lại trang chủ</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>