<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dang nhap</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-conter">
            <div class="col-md-4">
                <h2 class="text-center mb-4">dang nhap</h2>

                @if($errors->any())
                <div class="alert alert-danger">
                    {{$errors->first()}}
                </div>
                @endif
                <form action="{{route('login')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <button type="submit" class="btn btn-primary">dang nhap</button>
                    <div class="text-center mt-3">
                        Chưa có tài khoản? <a href="{{ route('register') }}" class="text-decoration-none fw-bold">Đăng ký ngay</a>
                        <br><br>
                        <a href="{{ route('client.product.index') }}" class="text-decoration-none text-muted">← Quay lại Trang chủ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>