<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom CSS Link -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container-fluid login-container">
        <div class="row g-0">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-12 col-md-6 login-image">
                <img src="/Img/bg.jpg" alt="Login Image">
            </div>
            <div class="col-12 col-md-6 login-form-container d-flex justify-content-center flex-column">
                <div class="login-form">
                    <form method="POST" action="{{ route('session.auth') }}">
                        <img src="https://img.icons8.com/ios-filled/100/000000/user.png" alt="User Icon" class="user-icon">
                        <input type="text" name="name" class="form-control" placeholder="Name">
                        <input type="password" name="name" class="form-control" placeholder="Password">
                        <button type="submit" class="btn btn-primary">Login</button>
                        <div class="additional-links">
                            <p>No account? <a href="{{ route('session.register') }}">Sign in</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



<!-- Scripts -->
    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>