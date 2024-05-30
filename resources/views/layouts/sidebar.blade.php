<!DOCTYPE html>

<html>

<head>
    <title>Sidebar</title>
</head>

<body>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
        <div class="offcanvas-header gap-3">
            <svg style="max-width: 8%;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path
                    d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z" />
            </svg>
            <h5 class="offcanvas-title" id="offcanvasMenuLabel">Hello, {{ $username }}!</h5>
            <!-- Buat Ini Jadi Username Akun -->
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body background_sidebar_color">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <b>
                        <h6><a class="nav-link active" aria-current="page" href="{{ route('dashboard.main') }}">Home</a>
                        </h6>
                    </b>
                </li>
                <li class="nav-item">
                    <b>
                        <h6><a class="nav-link" href="{{ route('dashboard.former') }}">Former events</a></h6>
                    </b>
                </li>
                <li class="nav-item">
                    <b>
                        <h6><a class="nav-link" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#transactionHistoryModal" onclick="append()">Transaction History</a>
                        </h6>
                    </b>
                </li>
            </ul>
            <form class="d-flex mt-3" action="{{ route('dashboard.former') }}" method="GET" role="search">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div class="upcoming-events mt-4 jam no_padding_margin">
                <b>
                    <h6>Upcoming event:</h6>
                </b>
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
                <b>
                    <h6>Sponsored by</h6>
                </b>
                <div class="container">
                    <div class="row">
                        <div class="col-5 mb-3">
                            <div class="sponsor-item bg-light rounded"><img class="img-fluid p-1 rounded"
                                    src="Img/sponsor1.jpeg" alt="Sponsor"></div>
                        </div>
                        <div class="col-5 mb-3">
                            <div class="sponsor-item bg-light rounded"><img class="img-fluid p-1 rounded"
                                    src="Img/sponsor2.jpeg" alt="Sponsor"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5 mb-3">
                            <div class="sponsor-item bg-light rounded"><img class="img-fluid p-1 rounded"
                                    src="Img/sponsor3.png" alt="Sponsor"></div>
                        </div>
                        <div class="col-5 mb-3">
                            <div class="sponsor-item bg-light rounded"><img class="img-fluid p-1 rounded"
                                    src="Img/sponsor4.png" alt="Sponsor"></div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item text-center mt-2">
                    <b>
                        <h6><a class="nav-link cr logout_color rounded" href="#">Logout</a></h6>
                    </b>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>
