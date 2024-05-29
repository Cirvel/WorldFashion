<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom CSS Link -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<div id="staticAlert" class="position-fixed fixed-top m-3"></div>

<body class="default_color">
    <!-- Sidebar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu"
                aria-controls="offcanvasMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="d-flex justify-content-end" href="#"><img style="max-width: 30%;"
                    src="Img/world_fashion_logo.jpg" alt="Logo"></a>
            <!-- navbar-brand ms-3 img-fluid -->
        </div>
    </nav>
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
                        <h6><a class="nav-link active" aria-current="page" href="#">Home</a></h6>
                    </b>
                </li>
                <li class="nav-item">
                    <b>
                        <h6><a class="nav-link" href="#">Former events</a></h6>
                    </b>
                </li>
                <li class="nav-item">
                    <b>
                        <h6><a class="nav-link" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#transactionHistoryModal" href="#">Transaction History</a></h6>
                    </b>
                </li>
            </ul>
            <form class="d-flex mt-3" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
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
    <!-- Transaction History -->
    <div class="modal fade" id="transactionHistoryModal" tabindex="-1"
        aria-labelledby="transactionHistoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transactionHistoryModalLabel">Transaction History</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Transaction Card Example -->
                    @foreach ($transactions as $transaction)
                        <div id="transaction-{{ $transaction->id }}" class="transaction-card"
                            onclick="get({{ $transaction }})" data-bs-toggle="modal"
                            data-bs-target="#historyDetail">
                            <div class="d-flex justify-content-between">
                                <span>ID: KDWF-{{ $transaction->code }}</span>
                                @if ($transaction->confirmed)
                                    <span class="status-success">Success</span>
                                @else
                                    <span class="status-pending">Pending</span>
                                @endif
                            </div>
                            <div class="mt-2">{{ $transaction->created_at }}</div>
                            <div class="mt-2">{{ $transaction->amount }} {{ $transaction->fk_ticket_id->name }}
                                Ticket</div>
                            <div class="mt-2">{{ number_format($transaction->total) }}</div>
                        </div>
                    @endforeach
                    <div class="transaction-card" data-bs-toggle="modal" data-bs-target="#transactionDetailModal2">
                        <div class="d-flex justify-content-between">
                            <span>ID: FF-1714646394-LVR2MDIWZ79H8CR</span>
                            <span class="status-pending">Pending</span>
                        </div>
                        <div class="mt-2">02/05/2024</div>
                        <div class="mt-2">5 Tiket World Fashion</div>
                        <div class="mt-2">Rp. 500.000,00</div>
                    </div>
                    <div class="transaction-card" data-bs-toggle="modal" data-bs-target="#transactionDetailModal3">
                        <div class="d-flex justify-content-between">
                            <span>ID: FF-1714646294-VNWP79AZYGRESID</span>
                            <span class="status-expired">Expired</span>
                        </div>
                        <div class="mt-2">02/05/2024</div>
                        <div class="mt-2">1 Tiket World Fashion</div>
                        <div class="mt-2">Rp. 100.000,00</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction Detail -->
    <div class="modal fade" id="historyDetail" tabindex="-1" aria-labelledby="historyDetailLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transactionDetailModal1Label">Transaction Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="h-id">Transaction ID: WDP-1715414831-H509BRF0SGF0K0</p>
                    <p id="h-status">Status: Success</p>
                    <p id="h-date">Date: 11/05/2024</p>
                    <p id="h-ticket">Item: 2 Tiket World Fashion</p>
                    <p id="h-total">Amount: Rp. 200.000,00</p>
                </div>
            </div>
        </div>
    </div>

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
                    <p>Prepare to be dazzled as top designers showcase their latest collections on the runway. Discover
                        the hottest trends and find inspiration for your wardrobe. Immerse yourself in the glamorous
                        atmosphere, mingle with industry insiders, and experience the excitement of the fashion world
                        firsthand.</p>
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
    <!-- Countdown Event -->
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
                <b>
                    <p>Don't miss this opportunity to indulge your passion for fashion and be a part of an unforgettable
                        event!</p>
                </b>
            </div>
        </div>
    </div>
    <!-- Popup -->
    <div class="container">
        <!-- Trigger button for the modal -->
        <div class="row">
            <div class="col d-flex justify-content-center">
                <button type="button" class="btn btn-primary mt-5" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <h1>PRE ORDER NOW</h1>
                </button>
            </div>
            <p id="p1"></p>
        </div>
        <!-- Modal 1 -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pre Order form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Horizontal form with input fields -->
                        <form id="order_form" action="{{ route('transactions.store') }}" method="POST">
                            @csrf
                            @method('post')
                            <div class="mb-3 row">
                                <label for="ticket_id" class="col-sm-2 col-form-label">Ticket</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="ticket_id" id="ticket_id" onchange="ticket()">
                                        @foreach ($tickets as $ticket)
                                            <option value="{{ $ticket->id }}"
                                                title="Stock left: {{ $ticket->stock }}">{{ $ticket->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="price" id="price" value="0"
                                readonly>
                            <input type="hidden" class="form-control" name="user_id" id="user_id"
                                value="{{ auth()->id() }}" readonly>
                            <div class="mb-3 row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Nama" value="{{ auth()->user()->name }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="no_telp" class="col-sm-2 col-form-label">No. Telepon</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no_telp" name="no_telp"
                                        placeholder="No Telepon" value="{{ auth()->user()->no_telp }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Email" value="{{ auth()->user()->email }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="amount" class="col-sm-2 col-form-label">Amount</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="amount" name="amount"
                                        min="1" max="10" onchange="calculateTotal()">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="total" class="col-sm-2 col-form-label">Total</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="total" name="total"
                                        value="0" readonly>
                                </div>
                            </div>
                            <div class="container container-md" id="errorPreOrder">
                            </div>
                            <button type="button" class="btn btn-primary w-100" id="submitBtn"
                                onclick="payNow()">Next</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal 2 (CAPTCHA) -->
        <div class="modal fade" id="captchaModal" tabindex="-1" aria-labelledby="captchaModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="captchaModalLabel">CAPTCHA Verification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="captchaInput" class="form-label">Enter the text shown in the image below:</label>
                            <div id="captcha" class="mb-3 w-100 text-center">
                                <span></span>
                                <button type="button" class="btn btn-warning ms-auto" onclick="regenCaptcha()">
                                    <i class="fas fa-refresh" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div id="errorCaptcha" class="mb-3"></div>
                            <input type="text" name="captcha" id="captchaInput" class="form-control" placeholder="CAPTCHA">
                        </form>
                        </div>
                        <button type="button" class="btn btn-primary w-100" id="submitCaptchaBtn">Next</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal 3 -->
        <div class="modal fade" id="nextInputModal" tabindex="-1" aria-labelledby="nextInputModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="nextInputModalLabel">Pay Now</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row ms-1 me-1 d-flex no_padding_margin">
                            <div class="col-12 col-md-4 text-start">
                                <b>
                                    <p class="no_padding_margin">Tanggal:</p>
                                </b>
                                <p class="no_padding_margin">22/05/2024</p>
                            </div>
                            <div class="col-12 col-md-4 text-start">
                                <b>
                                    <p class="no_padding_margin">Kode:</p>
                                </b>
                                <p class="no_padding_margin">KWDF-123456789109</p>
                            </div>
                            <div class="col-12 col-md-4 text-start">
                                <b>
                                    <p class="no_padding_margin">Status:</p>
                                </b>
                                <p class="no_padding_margin">Belum Dibayar</p>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class="col-md-4 text-center d-flex flex-column justify-content-center align-items-center pt-3 pb-3">
                                <div class="d-flex justify-content-center gap-2">
                                    <div class="cr">
                                        <h3 class="countdown_text no_padding_margin">8</h3>
                                        <h4 class="countdown_text no_padding_margin">Hrs</h4>
                                    </div>
                                    <div class="cr">
                                        <h3 class="countdown_text no_padding_margin">0</h3>
                                        <h4 class="countdown_text no_padding_margin">Min</h4>
                                    </div>
                                    <div class="cr">
                                        <h3 class="countdown_text no_padding_margin">0</h3>
                                        <h4 class="countdown_text no_padding_margin">Sec</h4>
                                    </div>
                                </div>
                                <div class="row mt-3" id="qr">
                                    <img src="/Img/logo_tm.png" alt="QR Code" class="img-fluid">
                                    <!-- QR Code Here -->
                                </div>
                            </div>
                            <div class="col-12 col-md-8 pe-0 mt-3">
                                <div class="row no_padding_margin">
                                    <div class="col-5 no_padding_margin fs-5 d-flex flex-column gap-1">
                                        <label class="pembelian_text" for="name">Name: </label>
                                        <label for="no.telp">No. Telp: </label>
                                        <label for="email">Email: </label>
                                        <label for="jumlah_tiket">Ticket: </label>
                                        <label for="total_bayar">Total: </label>
                                    </div>
                                    <div class="col-7 no_padding_margin fs-5 d-flex flex-column gap-1">
                                        <label id="name_2">Leon S. Castellanos</label>
                                        <label id="no_telp_2">821-1080-2307</label>
                                        <label id="email_2">sebskennedy0917@gmail.com</label>
                                        <label id="amount_2">2</label>
                                        <label id="total_2">Rp. 200.000,00</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-primary" id="closeConfirmationBtn"
                            data-bs-toggle="modal" data-bs-target=""
                            onclick="store_transactions()">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal 4 -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Pre Order Success</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Your pre-order has been submitted successfully!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- News -->
    <div class="container mt-5 mb-5 border border-2 rounded">
        <div class="row align-items-center border-0 border-md">
            <div class="col-md-4 p-0">
                <div class="square-container">
                    <img src="Img/news.jpeg" alt="Responsive Image" class="img-fluid rounded">
                </div>
            </div>
            <div class="col">
                <p class="fs-5 news_desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                    only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum </p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="main_color container-fluid">
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
                                <li><a href="#" class="cw text-decoration-none">Privacy Policy</a></li>
                                <li><a href="#" class="cw text-decoration-none">Return And Refund Policy</a>
                                </li>
                                <li><a href="#" class="cw text-decoration-none">Customer Service</a></li>
                                <li><a href="#" class="cw text-decoration-none">Feedback</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <h3 class="cw pb-2 border-bottom">The Company</h3>
                            <ul class="list-unstyled">
                                <li><a href="#" class="cw text-decoration-none">About</a></li>
                                <li><a href="#" class="cw text-decoration-none">Careers</a></li>
                                <li><a href="#" class="cw text-decoration-none">Store Locator</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <h3 class="cw pb-2 border-bottom mt-3">More</h3>
                            <ul class="list-unstyled">
                                <li><a href="#" class="cw text-decoration-none">Franchise</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <h3 class="cw pb-2 mt-3">Follow Us</h3>
                            <div class="d-flex gap-2">
                                <i style="font-size: 1.5rem;" class="fa-brands fa-twitter"></i>
                                <i style="font-size: 1.5rem;" class="fa-brands fa-instagram"></i>
                                <i style="font-size: 1.5rem;" class="fa-brands fa-youtube"></i>
                                <i style="font-size: 1.5rem;" class="fa-brands fa-facebook-f"></i>
                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script type="text/javascript">
        countdownTimer();

        /* Set hidden value 'price' depending on the ticket price */
        function ticket() {
            var id = $('#ticket_id').val();
            $.ajax({ // Ajax script
                url: "{{ route('tickets.price') }}", // Route
                type: "GET", // Method
                data: {
                    'ticket': id
                }, // Set parameters
                success: function(data) { // Set price as return value
                    $('#price').val(data);
                }
            })
        }
        ticket();

        /* Set transaction detail data from their id */
        function get(id) {
            $.ajax({
                url: "{{ route('transactions.get') }}",
                type: "GET",
                data: {
                    'transaction': id
                },
                success: function(data) {
                    document.getElementById("h-status").innerHTML = "Status:".data.status;
                    alert('success getting data');
                },
                error: function() {
                    alert('failed getting data');
                }
            })
        }

        /* Change the modal 2 (Pay now) datas upon continuing from modal 1 (Pre order) */
        function payNow() {
            $.ajax({ // Ajax script
                url: "{{ route('qr_ajax') }}", // Route
                type: "GET", // Method
                // processData: false,
                // contentType: false,
                data: {
                    'link': 'https://stackoverflow.com/questions/2901102/how-to-format-a-number-with-commas-as-thousands-separators'
                }, // Parameters
                success: function(data) { // Set price as return value
                    document.getElementById('qr').innerHTML = data;
                },
                error: function(message, error) {
                    alert(message.status);
                }
            })

            // Get values
            var name = $('#name').val();
            var no_telp = $('#no_telp').val();
            var email = $('#email').val();
            var amount = $('#amount').val();
            var total = $('#total').val();

            // Alter text
            document.getElementById('name_2').innerHTML = name;
            document.getElementById('no_telp_2').innerHTML = no_telp;
            document.getElementById('email_2').innerHTML = email;
            document.getElementById('amount_2').innerHTML = amount;
            document.getElementById('total_2').innerHTML = "Rp. "+ new Intl.NumberFormat().format(total);
        }

        /* Store data using AJAX */
        function store_transactions() {
            $.ajax({ // Ajax script
                url: "{{ route('transactions.store') }}", // Route
                type: "POST", // Method
                data: $('#order_form').serializeArray(), // Parameters
                success: function(data) { // Set price as return value
                    b5_alert("staticAlert", "<strong>Transaction successfully submit</strong>", "success");
                    alert('success');
                },
                error: function(message, error) {
                    alert("Error code : ". message.status);
                }
            })
        }

        /* Regenerate captcha form */
        function regenCaptcha(entry = true) {
            /* Regenerate captcha */

            if (entry) {
                $('#errorCaptcha').html("");
            }
            $.ajax({
                url: "{{ route('recaptcha') }}",
                type: "GET",
                success: function(data) {
                    $('#captchaInput').val("");
                    $('#captcha span').html(data.captcha);
                },
                error: function(message, error) {
                    alert("Error code : ". message.status);
                }
            })
        };

        $('#submitBtn').click(function(e) {
            /* Only continue onto the next popup if all the fiels are filled */
            const name = document.getElementById('name').value;
            const no_telp = document.getElementById('no_telp').value;
            const email = document.getElementById('email').value;
            const amount = document.getElementById('amount').value;


            if (name && no_telp && email && amount) {
                var firstModal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
                firstModal.hide();
                var secondModal = new bootstrap.Modal(document.getElementById('captchaModal'));
                regenCaptcha();
                secondModal.show();
            } else {
                b5_alert("errorPreOrder", "Please fill out all the fields", "danger");
                // alert('Please fill all the fields');
            }

        });
        $('#submitCaptchaBtn').click(function(e) {
            var captcha = $('#captchaInput').val();
            $.ajax({
                url: "{{ route('nocaptcha') }}",
                type: "GET",
                data: {
                    'captcha': captcha
                },
                success: function(data){
                    var currModal = bootstrap.Modal.getInstance(document.getElementById('captchaModal'));
                    currModal.hide();
                    var nextModal = new bootstrap.Modal(document.getElementById('nextInputModal'));
                    nextModal.show();
                    b5_alert("staticAlert", "Captcha passed", "success");
                },
                error: function(message, error){
                    regenCaptcha(false);
                    b5_alert("errorCaptcha", "Captcha failed", "danger");
                }
            })
        });

        /* Popup continue function */
        document.addEventListener('hidden.bs.modal', function(event) {
            if (document.querySelectorAll('.modal.show').length === 0) {
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.parentNode.removeChild(backdrop);
                }
                document.body.classList.remove('modal-open');
                document.body.style.paddingRight = '';
            }
        });

    </script>
</body>

</html>
