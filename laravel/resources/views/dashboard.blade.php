<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom CSS Link -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>

<body class="default_color">
   <!-- Sidebar -->
   <nav class="navbar navbar-dark bg-dark d-flex flex-nowrap">
        <div class="container-fluid">
            <button class="navbar-toggler" ty   pe="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand img-fluid" href="#"><img style="max-width: 30%;" src="Img/world_fashion_logo.jpg" alt="Logo"></a>
        </div>
    </nav>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
        <div class="offcanvas-header gap-3">
        <svg style="max-width: 8%;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg>
            <h5 class="offcanvas-title" id="offcanvasMenuLabel">Hello, {{ $username }}!</h5>   <!-- Buat Ini Jadi Username Akun -->
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body background_sidebar_color">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <b><h6><a class="nav-link active" aria-current="page" href="{{ route('dashboard.main') }}">Home</a></h6></b>
                </li>
                <li class="nav-item">
                    <b><h6><a class="nav-link" href="{{ route('dashboard.former') }}">Former events</a></h6></b>
                </li>
            </ul>
            <form class="d-flex mt-3" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div class="upcoming-events mt-4 jam no_padding_margin">
                <b><h6>Upcoming event:</h6></b>
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-2 text-center no_padding_margin">
                                <h4 class="no_padding_margin">19</h4>
                                <h4 class="no_padding_margin">OCT</h4>
                            </div>
                            <div class="col-6 no_padding_margin text-center">
                                <p class="no_padding_margin">4:00 pm - 8:00 pm</p>
                                <h4>Abu Dhabi</h4>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-2 text-center no_padding_margin">
                            <h4 class="no_padding_margin">25</h4>
                            <h4 class="no_padding_margin">OCT</h4>
                        </div>
                        <div class="col-6 no_padding_margin text-center">
                            <p class="no_padding_margin">4:00 pm - 8:00 pm</p>
                            <h4>New York</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sponsored-by mt-4">
                <b><h6>Sponsored by</h6></b>
                <div class="container">
                    <div class="row">
                        <div class="col-5 mb-3">
                            <div class="sponsor-item bg-light rounded"><img class="img-fluid p-1 rounded" src="Img/bg.jpg" alt="Sponsor"></div>
                        </div>
                        <div class="col-5 mb-3">
                            <div class="sponsor-item bg-light rounded"><img class="img-fluid p-1 rounded" src="Img/bg.jpg" alt="Sponsor"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5 mb-3">
                            <div class="sponsor-item bg-light rounded"><img class="img-fluid p-1 rounded" src="Img/bg.jpg" alt="Sponsor"></div>
                        </div>
                        <div class="col-5 mb-3">
                            <div class="sponsor-item bg-light rounded"><img class="img-fluid p-1 rounded" src="Img/bg.jpg" alt="Sponsor"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Header Video -->
     <div class="container-fluid gx-0">
        <div class="image-container">
            <div class="ratio ratio-16x9">
                <video class="video-bg" src="{{ asset('video/fashionshow.mp4') }}" autoplay loop muted playsinline></video>
            </div>
            <div class="text-overlay">
                <div class="overlay_header">
                    <b>Global Fashion 2017</b>
                    <br>
                    Abu Dhabi
                </div>
                <div class="overlay_desc">
                    <p>Prepare to be dazzled as top designers showcase their latest collections on the runway. Discover the hottest trends and find inspiration for your wardrobe. Immerse yourself in the glamorous atmosphere, mingle with industry insiders, and experience the excitement of the fashion world firsthand.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Three Videos -->
    <div class="container">
        <div class="row mt-3 mb-5">
            <div class="col-4">
                <video class="video-bg img-fluid" src="{{ asset('video/smallvid1.mp4') }}" controls></video>
            </div>
            <div class="col-4">
                <video class="video-bg img-fluid" src="{{ asset('video/smallvid2.mp4') }}" controls></video>
            </div>
            <div class="col-4">
                <video class="video-bg img-fluid" src="{{ asset('video/smallvid3.mp4') }}" controls></video>
            </div>
        </div>
    </div>
    <!-- Countdown Event -->    <!-- NEED BACKEND -->
    <div class="container">
        <div class="row text-center">
            <div class="col">
                <h2>Fashion Event</h2>
                <h3>19 OCT, 18.00</h3>
            </div>
        </div>
        <div id="countdown" class="row text-center d-flex justify-content-center pt-3 pb-3">
            <div class="col-2">
                <h1>04</h1>
                <h3>Days</h3>
            </div>
            <div class="col-2">
                <h1>14</h1>
                <h3>Hrs</h3>
            </div>
            <div class="col-2">
                <h1>20</h1>
                <h3>Min</h3>
            </div>
            <div class="col-2">
                <h1>28</h1>
                <h3>Sec</h3>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-2 mb-2 pt-3 pb-3">
            <div class="col-6 text-center">
                <b><p>Don't miss this opportunity to indulge your passion for fashion and be a part of an unforgettable event!</p></b>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <a href="{{ route('booking') }}">
                    <div class="btn btn-primary rounded">
                        <h1>PRE-ORDER NOW</h1>      <!-- Perlu Warna Yang Lebih Mencolok -->
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- News -->
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-4">
                <div class="square-container">
                    <img src="Img/bg.jpg" alt="Responsive Image" class="img-fluid">
                </div>
            </div>
            <div class="col">
                <p class="fs-5 overlay_desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum </p>
            </div>
        </div>
    </div>
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
                        <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d3613.8073542448806!2d55.1406664!3d25.0745178!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sid!4v1716210390196!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <h3 class="cw pb-2 border-bottom">Help & FAQ</h3>
                            <ul class="list-unstyled">
                                <li><a href="#" class="cw">Privacy Policy</a></li>
                                <li><a href="#" class="cw">Return And Refund Policy</a></li>
                                <li><a href="{{ route('booking') }}" class="cw">Customer Service</a></li>
                                <li><a href="{{ route('session.logout') }}" class="cw">Feedback</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <h3 class="cw pb-2 border-bottom">The Company</h3>
                            <ul class="list-unstyled">
                                <li><a href="{{ route('dashboard.admin') }}" class="cw">About</a></li>
                                <li><a href="{{ route('transactions.show',2) }}" class="cw">Careers</a></li>
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
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript">
        countdownTimer();
    </script>
</body>
</html>