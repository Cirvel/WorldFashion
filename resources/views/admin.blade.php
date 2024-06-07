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
    {{-- Alert --}}
    @if ($errors->any())
        <div
            class="alert alert-primary alert-dismissible fade show position-fixed fixed-top m-3"
            role="alert"
        >
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
            ></button>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        
    @endif

    <div class="d-flex m-3">
        <h3 class="form-label">EDIT DATABASE</h3>
        <div class="ms-auto">
            <span>{{ auth()->user()->name }}</span>
            <a href="{{ route('session.logout') }}">
                <button type="button" class="btn btn-danger">Logout</button>
            </a>
        </div>
    </div>

    <div class="list m-3">

        {{-- <form action="{{ route('mail') }}" method="GET" class="container container-md">
            <label for="id" class="form-label">Mail Demo</label>
            <input class="form-control mb-3" type="number" name="transaction" id="transaction" placeholder="Transaction ID">
            <button class="btn btn-primary mb-3">Generate</button>
        </form> --}}

        <a href="{{ route('users.index') }}">
            <div class="container-fluid btn btn-outline-primary mb-2">
                Users
            </div>
        </a>
        <a href="{{ route('news.index') }}">
            <div class="container-fluid btn btn-outline-primary mb-2">
                News
            </div>
        </a>
        <a href="{{ route('tickets.index') }}">
            <div class="container-fluid btn btn-outline-primary mb-2">
                Tickets
            </div>
        </a>
        {{-- <a href="{{ route('events.index') }}">
            <div class="container-fluid btn btn-outline-primary mb-2">
                Events
            </div>
        </a> --}}
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
