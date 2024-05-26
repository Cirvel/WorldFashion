<!DOCTYPE html>

<html lang="en" data-bs-theme="auto">

<head>
    <title>Edit Ticket</title>
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
        <form class="" method="POST" action="{{ route('transactions.update', $transaction->id) }}">
            @method('put')
            @csrf
            <div class="mb-3 d-flex">
                <h3 class="form-label">EDIT TICKET</h3>
                <div class="ms-auto">
                    <a href="{{ route('dashboard.main') }}">
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
                <select class="form-select" name="ticket_id" id="ticket_id" onchange="ticket()">
                    @foreach ($tickets as $ticket)
                        <option value="{{ $ticket->id }}" 
                            @if ($transaction->ticket_id == $ticket->id)
                                @selected(true)
                            @endif
                            title="Stock left: {{ $ticket->stock }}">{{ $ticket->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" name="price" id="price" value="0" readonly>
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" name="user_id" id="user_id"
                    value="{{ $transaction->user_id }}">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name"
                    value="{{ $transaction->name }}">
            </div>
            <div class="mb-3">
                <label for="no_telp" class="form-label">No. Telp</label>
                <input type="text" class="form-control" name="no_telp" id="no_telp"
                    value="{{ $transaction->no_telp }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email"
                    value="{{ $transaction->email }}">
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" class="form-control" name="amount" id="amount"
                    value="{{ $transaction->amount }}" onchange="calculateTotal()" required>
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="number" class="form-control" name="total" id="total"
                    value="{{ $transaction->total }}" readonly>
            </div>

            <div>
                <button class="btn btn-success d-md-inline d-none" type="submit">Submit</button>
                <button class="btn btn-success d-md-none d-inline" type="submit"><i class="fas fa-check"></i></button>
                <button class="btn btn-danger d-md-inline d-none" type="reset">Clear</button>
                <button class="btn btn-danger d-md-none d-inline" type="reset"><i class="fas fa-trash"></i></button>
            </div>
        </form>
    </div>
    </div>
</body>

<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script type="text/javascript">
    function ticket() {
        var id = $('#ticket_id').val(); // Get selected sort value
        $.ajax({ // Ajax script
            url: "{{ route('transactions.ticket') }}", // Route
            type: "GET", // Method
            data: {
                'ticket': id
            }, // Set parameters
            success: function(data) { // If process has no error..
                $('#price').val(data); // Set hidden value 'price' depending on the ticket price
            }
        })
    };
    ticket();
</script>

</html>
