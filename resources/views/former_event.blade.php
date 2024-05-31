<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Former Event</title>
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom CSS Link -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<div id="staticAlert" class="position-fixed fixed-top m-3"></div>

@include('layouts.transaction_history')

@include('layouts.transaction_detail')

<body class="default_color">
    @include('layouts.header')

    @include('layouts.sidebar')
    <!-- Header Video -->
    <div class="container-fluid gx-0">
        <div class="image-container">
            <div class="ratio ratio-16x9">
                <video class="video-bg" src="{{ asset('video/fashionshow.mp4') }}" autoplay loop muted
                    playsinline></video>
            </div>
            <div class="text-overlay">
                <div class="overlay_header">
                    <b>Global Fashion 2017</b>
                    <br>
                    Abu Dhabi
                </div>
                <div class="overlay_desc">
                    <p class="fs-2">Prepare to be dazzled as top designers showcase their latest collections on the
                        runway. Discover the hottest trends and find inspiration for your wardrobe. Immerse yourself in
                        the glamorous atmosphere, mingle with industry insiders, and experience the excitement of the
                        fashion world firsthand.</p>
                </div>
            </div>
        </div>
    </div>

    <form class="container d-flex mt-3" action="{{ route('dashboard.former') }}" method="GET" role="search">
        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search" value="{{ app('request')->input('search') }}">
        <button class="btn btn-outline-secondary" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </form>
    @if (count($news) == 0)
        <div class="text-center my-5">
            <h3>
                <i class="fa fa-frown"></i>
            </h3>
            <p class="fs-3"> No result </p>
        </div>
    @endif

    @foreach ($news as $former)
        @if ($loop->iteration % 2 == 0 && $loop->iteration <= 2)
            <!-- News Left -->
            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col-4">
                        <div class="square-container">
                            <img src="img/news/{{ $former->image }}" alt="$former->image" class="img-fluid">
                        </div>
                    </div>
                    <div class="col">
                        <p class="fs-3">{{ $former->title }}</p>
                        <p class="fs-5">{{ $former->description }}</p>
                    </div>
                </div>
            </div>
        @elseif ($loop->iteration <= 2)
            <!-- News Right -->
            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col">
                        <p class="fs-3">{{ $former->title }}</p>
                        <p class="fs-5">{{ $former->description }}</p>
                    </div>
                    <div class="col-4">
                        <div class="square-container">
                            <img src="img/news/{{ $former->image }}" alt="$former->image" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <!-- Six Piece Pics -->
    @if (count($news) > 2)
        <div class="container flex-wrap">
            <div class="row mb-3">
                @foreach ($news as $former)
                    @if ($loop->iteration > 2)
                        <div class="col-4">
                            <div class="ratio-3x2 mt-3">
                                <img src="img/news/{{ $former->image }}" alt="{{ $former->image }}"
                                    title="{{ $former->title }}" class="img-fluid">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    @include('layouts.footer')

    @include('script')

    <script type="text/javascript">
        append();
    </script>
</body>

</html>
