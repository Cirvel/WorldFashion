<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
<head>
    <title>World Fashion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/myjs.js')}}"></script>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="d-flex m-3">
        <h3 class="form-label">EDIT DATABASE</h3>
        <div class="ms-auto">
            <a href="{{ route('dashboard.main') }}">
                <button type="button" class="btn btn-danger">Return</button>
            </a>
        </div>
    </div>

    <div class="list m-3">
        <a href="{{ route('users.index') }}">
            <div class="container-fluid btn btn-outline-primary mb-2">
                Users
            </div>
        </a>
        <a href="{{ route('events.index') }}">
            <div class="container-fluid btn btn-outline-primary mb-2">
                Events
            </div>
        </a>
        <a href="{{ route('transactions.index') }}">
            <div class="container-fluid btn btn-outline-primary mb-2">
                Transactions
            </div>
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{asset('js/myjs.js')}}"></script>
</body>
</html>