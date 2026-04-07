<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h4 class="mb-0">Đăng ký tài khoản</h4>
                    </div>
                    <div class="card-body p-4">
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Họ và Tên</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Nhập họ và tên..." required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Nhập địa chỉ email..." required>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-bold">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu..." required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3 fw-bold">Đăng Ký Ngay</button>
                            
                            <div class="text-center mt-3">
                                Đã có tài khoản? <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Đăng nhập</a>
                                <br><br>
                                <a href="{{ route('client.product.index') }}" class="text-decoration-none text-muted">← Quay lại Trang chủ</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>