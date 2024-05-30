<!DOCTYPE html>

<html lang="en" data-bs-theme="auto">

<head>
    <title>News</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="m-2">
    <!-- Body -->
    <div class="mb-3"></div>
    <div class="container-md form-control mx-auto p-2">
        <form class="" method="POST" action="{{ route('news.update', $news->id) }}">
            @csrf
            @method('put')
            <div class="mb-3 d-flex">
                <h3 class="form-label">EDIT NEWS</h3>
                <div class="ms-auto">
                    <a href="{{ route('news.index') }}">
                        <button type="button" class="btn btn-close"></button>
                    </a>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title"
                    title="Original value: {{ $news->title }}" value="{{ $news->title }}" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="10"
                    title="Original value: {{ $news->title }}" required>{{ $news->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image <sup>Ignore to keep image</sup></label>
                <input type="file" class="form-control" name="image" id="image" accept="image/*" required>
            </div>

            <div>
                <button class="btn btn-success d-md-inline d-none" type="submit">Submit</button>
                <button class="btn btn-success d-md-none d-inline" type="submit"><i class="fas fa-check"></i></button>
                <button class="btn btn-danger d-md-inline d-none" type="reset">Clear</button>
                <button class="btn btn-danger d-md-none d-inline" type="reset"><i class="fas fa-trash"></i></button>
            </div>
        </form>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

</html>
