<!DOCTYPE html>

<html lang="en" data-bs-theme="auto">

<head>
    <title>Payment</title>
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
    <div class="card">
        <div class="card-header d-flex offcanvas-bottom">
            <div class="">
                {{-- <a href="{{ route('rebooking', $transaction->id) }}">
                    <div class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i>
                        <span class="d-none d-md-inline"> Edit</span>
                    </div>
                </a> --}}
            </div>
            <div class="ms-auto">
                @if (auth()->user()->level == "admin")
                <a href="{{ route('transactions.index') }}">
                    <button class="btn btn-close"></button>
                </a>
                @else
                <a href="{{ route('dashboard.main') }}">
                    <button class="btn btn-close"></button>
                </a>
                @endif
            </div>
        </div>
        <div class="card-body d-inline d-sm-flex">
            <div class="text-center d-flex flex-column flex-wrap">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>
                                {{ $qr_code }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>KDWF-{{ $transaction->code }}</b>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class=" m-0 ms-md-3">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>{{ $transaction->name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{ $transaction->email }}</td>
                        </tr>
                        <tr>
                            <td>No. Telp</td>
                            <td>:</td>
                            <td>{{ $transaction->no_telp }}</td>
                        </tr>
                        <tr>
                            <td>Amount</td>
                            <td>:</td>
                            <td>{{ $transaction->amount }}</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>:</td>
                            <td>Rp. {{ number_format($transaction->total, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Confirmed</td>
                            <td>:</td>
                            @if ($transaction->confirmed)
                                <td class="text-success">
                                    <i class="fa-regular fa-circle-check" aria-hidden="true"></i><span
                                        class="d-none d-md-inline">
                                        True</span>
                                </td>
                            @else
                                <td class="text-danger">
                                    <i class="fa-regular fa-circle-xmark" aria-hidden="true"></i><span
                                        class="d-none d-md-inline">
                                        False</span>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <td>Bought At</td>
                            <td>:</td>
                            <td>{{ $transaction->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</body>

<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

</html>
