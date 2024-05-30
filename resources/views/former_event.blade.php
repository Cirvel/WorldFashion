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
    <!-- Sidebar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu"
                aria-controls="offcanvasMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand ms-3 img-fluid" href="#"><img style="max-width: 30%;"
                    src="Img/world_fashion_logo.jpg" alt="Logo"></a>
        </div>
    </nav>
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

    <!-- Footer -->
    <footer class="main_color">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <h2 class="cw pt-1 pb-1">Location</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d3613.8073542448806!2d55.1406664!3d25.0745178!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sid!4v1716210390196!5m2!1sen!2sid"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <h3 class="cw pb-2 border-bottom">Help & FAQ</h3>
                            <ul class="list-unstyled">
                                <li><a href="#" class="cw">Privacy Policy</a></li>
                                <li><a href="#" class="cw">Return And Refund Policy</a></li>
                                <li><a href="#" class="cw">Customer Service</a></li>
                                <li><a href="#" class="cw">Feedback</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <h3 class="cw pb-2 border-bottom">The Company</h3>
                            <ul class="list-unstyled">
                                <li><a href="#" class="cw">About</a></li>
                                <li><a href="#" class="cw">Careers</a></li>
                                <li><a href="#" class="cw">Store Locator</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <h3 class="cw pb-2 border-bottom mt-3">More</h3>
                            <ul class="list-unstyled">
                                <li><a href="#" class="cw">Franchise</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <h3 class="cw pb-2 mt-3">Follow Us</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-3">
            <div class="row">
                <div class="col-12 text-center pt-2 border-top">
                    <p class="cw">© 2024 World Fashion</p>
                </div>
            </div>
        </div>
    </footer>

    @include('script')

    <script>
        append();
    </script>
</body>

</html>
