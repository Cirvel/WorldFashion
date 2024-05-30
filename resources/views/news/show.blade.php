<!DOCTYPE html>

<html lang="en" data-bs-theme="auto">

<head>
    <title>News</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/myjs.js') }}"></script>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="m-2">
    <!-- Body -->
    <div class="mb-3"></div>
    <div class="container-md form-control mx-auto p-2">
        <div class="mb-3 d-flex">
            <h3 id="title" class="form-label">{{ $news->title }}</h3>
            <div class="ms-auto">
                <a href="{{ route('dashboard.former') }}">
                    <button type="button" class="btn btn-close"></button>
                </a>
            </div>
        </div>
        <div id="image" class="card-img image-container text-center">
            <img src="/img/news/{{ $news->image }}" alt="{{ $news->image }}" class="img-thumbnail">
        </div>
        <div id="body" class="card-body">
            <div id="desc" class="card-text">
                <p>{{ $news->description }}</p>
            </div>
        </div>
    </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

</html>
