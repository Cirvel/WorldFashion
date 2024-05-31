<!DOCTYPE html>

<html lang="en" data-bs-theme="auto">

<head>
    <title>World Fashion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/myjs.js') }}"></script>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="container container-fluid">
    <header class="text-center">
        <p class="fw-bold fs-3">PARTICIPANT</p>
        <div>
            {!! QrCode::size(256)->generate($link) !!}
        </div>
    </header>
    <hr>
    <p class="fw-medium fs-4">Hello, {{ $transaction->name }}</p>
    <p class="fs-5">
        Thank you for purchasing ticket for our events! <br>
        Please let the staff scan the QR code above before enjoying your visit.
    </p>
    <br>
    <footer>
        <p class="fs-5">
            {{ config('app.name') }}
        </p>
    </footer>
</body>

</html>
