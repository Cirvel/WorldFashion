<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{asset('css/mycss.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/style.css') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>World Fashion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>

<body>
   
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand ms-3 img-fluid" href="#"><img style="max-width: 30%;" src="Img/world_fashion_logo.jpg" alt="Logo"></a>
        </div>
    </nav>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
        <div class="offcanvas-header gap-3">
        <svg style="max-width: 8%;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg>
            <h5 class="offcanvas-title" id="offcanvasMenuLabel">Hello, Majid!</h5>   <!-- Buat Ini Jadi Username Akun -->
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body kontol">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <b><a class="nav-link active" aria-current="page" href="#">Home</a></b>
                </li>
                <li class="nav-item">
                    <b><a class="nav-link" href="#">Former events</a></b>
                </li>
            </ul>
            <form class="d-flex mt-3" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div class="upcoming-events mt-4 jam">
                <h6>Upcoming event:</h6>
                <div class="container">
                    <div class="row">
                    <div class="col-2 text-center no_padding_margin">
                            <h4 class="no_padding_margin">19</h4>
                            <h4 class="no_padding_margin">OCT</h4>
                        </div>
                        <div class="col-6 text-center">
                            <p class="no_padding_margin">4:00 pm - 8:00 pm</p>
                            <h4>New York</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2 text-center no_padding_margin">
                            <h4 class="no_padding_margin">25</h4>
                            <h4 class="no_padding_margin">OCT</h4>
                        </div>
                        <div class="col-6 text-center">
                            <p class="no_padding_margin">4:00 pm - 8:00 pm</p>
                            <h4>New York</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sponsored-by mt-4">
                <h6>Sponsored by</h6>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="sponsor-item bg-light img-fluid"><img src="Img/logo_tm.png" alt="Logo TM"></div>
                        </div>
                        <div class="col">
                            <div class="sponsor-item bg-light img-fluid"><img src="Img/logo_tm.png" alt="Logo TM"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="sponsor-item bg-light img-fluid"><img src="Img/logo_tm.png" alt="Logo TM"></div>
                        </div>
                        <div class="col">
                            <div class="sponsor-item bg-light img-fluid"><img src="Img/logo_tm.png" alt="Logo TM"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content container mt-4">
        <header class="text-center text-white bg-cover" style=" padding: 100px 20px;">
            <h1>Global Fashion 2017 Abu Dhabi</h1>
            <p>Prepare to be dazzled as top designers showcase their latest collections...</p>
        </header>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{asset('js/myjs.js')}}"></script>
</body>
</html>
