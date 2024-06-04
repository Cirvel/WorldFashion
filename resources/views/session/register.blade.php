 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="login-form my-3">
                    <h2 class="mb-4">Sign In</h2>
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
                    <form method="POST" action="{{ route('session.create') }}" class="text-start">
                        @csrf
                        {{-- <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="username">
                        </div> --}}
                        <div class="mb-3">
                            <b><label for="name" class="form-label">Name</label></b>
                            <input type="text" class="form-control" name="name" id="name" maxlength="15" required data-bs-toggle="tooltip" data-bs-placement="right"  title="Need 4-15 characters">
                        </div>
                        <div class="mb-3">
                            <b><label for="email" class="form-label">Email</label></b>
                            <input type="email" class="form-control" name="email" id="email" required data-bs-toggle="tooltip" data-bs-placement="right"  title="Need @gmail.com">
                        </div>
                        <div class="mb-3">
                            <b><label for="password" class="form-label">Password</label></b>
                            <input type="password" class="form-control" name="password" id="password" maxlength="8" required data-bs-toggle="tooltip" data-bs-placement="right"  title="Need 8-20 alphabet, min 1 number, min 1 character (!@#$&%)">
                            {{-- <input type="password" class="form-control" name="password" id="password" maxlength="8" data-toggle="password" required> --}}
                        </div>
                        <div class="mb-3">
                            <b><label for="no_telp" class="form-label">No. Telp</label></b>
                            <input type="text" class="form-control" name="no_telp" id="no_telp" maxlength="13" required data-bs-toggle="tooltip" data-bs-placement="right"  title="Need 11-13 numbers">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Sign-in</button>
                        <div class="additional-links text-center">
                            <p>Already have an account? <a href="{{ route('session.login') }}">Log in</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.3.0/dist/bootstrap-show-password.min.js"></script>
    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>