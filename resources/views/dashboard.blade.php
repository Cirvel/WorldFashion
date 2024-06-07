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

@include('layouts.alert')

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
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pre Order form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Horizontal form with input fields -->
                        <form id="order_form" action="{{ route('transactions.store') }}" method="POST">
                            @csrf
                            @method('post')
                            <div class="mb-3 row">
                                <label for="ticket_id" class="col-sm-2 col-form-label">Ticket</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="ticket_id" id="ticket_id"
                                        onchange="ticket()">
                                        @foreach ($tickets as $ticket)
                                            @if ($ticket->stock > 0)
                                                <option value="{{ $ticket->id }}"
                                                    title="Stock left: {{ $ticket->stock }}">{{ $ticket->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="price" id="price" value="0"
                                readonly>
                            <input type="hidden" class="form-control" name="ticket_name" id="ticket_name"
                                value="" readonly>
                            <input type="hidden" class="form-control" name="user_id" id="user_id"
                                value="{{ auth()->id() }}" readonly>
                            <div class="mb-3 row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Nama" value="{{ auth()->user()->name }}" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="no_telp" class="col-sm-2 col-form-label">No. Telepon</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no_telp" name="no_telp"
                                        placeholder="No Telepon" value="{{ auth()->user()->no_telp }}" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Email" value="{{ auth()->user()->email }}" readonly>
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
                            <label for="captchaInput" class="form-label">Enter the text shown in the image
                                below:</label>
                            <div id="captcha" class="mb-3 w-100 text-center">
                                <span></span>
                                <button type="button" class="btn btn-warning ms-auto" onclick="regenCaptcha()">
                                    <i class="fas fa-refresh" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div id="errorCaptcha" class="mb-3"></div>
                            <input type="text" name="captcha" id="captchaInput" class="form-control"
                                placeholder="CAPTCHA">
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
                        {{-- <div class="row ms-1 me-1 d-flex no_padding_margin">
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
                        </div> --}}
                        <div class="row">
                            <div class="pe-0 mt-3">
                                <div class="row no_padding_margin">
                                    <table class="table table-borderless">
                                        <tbody class="fs-5">
                                            <tr>
                                                <td>Name</td>
                                                <td>:</td>
                                                <td>
                                                    <span id="name_2"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>No. Telp</td>
                                                <td>:</td>
                                                <td>
                                                    <span id="no_telp_2"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>:</td>
                                                <td>
                                                    <span id="email_2"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ticket</td>
                                                <td>:</td>
                                                <td>
                                                    <span id="amount_2"></span>x <span id="ticket_2"></span> Ticket
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total Cost</td>
                                                <td>:</td>
                                                <td>
                                                    Rp. <span id="total_2"></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-primary" id="closeConfirmationBtn"
                            data-bs-toggle="modal" data-bs-target="" onclick="store_transactions()">Confirm &
                            Submit</button>
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

    <form method="POST" id="test_mailer">

    </form>

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

    @include('layouts.footer')
</body>

@include('script')

<script type="text/javascript">
    countdownTimer();
    ticket();
</script>

</html>
