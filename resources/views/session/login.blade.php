<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom CSS Link -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container-fluid login-container">
        <div class="row">
            <div class="m-auto col-md-6 d-none d-md-block login-image">
                <img src="/Img/fashion-show.jpg" alt="Login Image">
            </div>
            <div class="col-12 col-md-6 login-form-container d-flex justify-content-center flex-column">
                <div class="login-form">
                    <form method="POST" action="{{ route('session.auth') }}">
                        @csrf
                        <img src="https://img.icons8.com/ios-filled/100/000000/user.png" alt="User Icon" class="user-icon">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show"
                                role="alert">
                                <button type="button" class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                <ul class="m-0">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <input type="text"
        name="name" class="form-control mb-3" placeholder="Name">
    <input id="password" type="password" name="password" class="form-control" placeholder="Password">
    {{-- <input id="password" type="password" name="password" class="form-control" placeholder="Password" data-toggle="password"> --}}
    <button type="submit" class="btn btn-primary">Login</button>
    <div class="additional-links">
        <p>No account? <a href="{{ route('session.register') }}">Sign in</a></p>
    </div>
    </form>
    </div>
    </div>
    </div>
    </div>



    <!-- Show Password Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.3.0/dist/bootstrap-show-password.min.js"></script>
    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    </body>

</html>