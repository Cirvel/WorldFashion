<!DOCTYPE html>

<html lang="en" data-bs-theme="auto">

<head>
    <title>Transactions</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/myjs.js') }}"></script>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<!-- Body -->

<body class="m-2">
    <div class="mb-3 d-flex">
        <h3 class="form-label">TRANSACTIONS</h3>
        <div class="ms-auto">
            <a href="{{ route('dashboard.admin') }}">
                <button type="button" class="btn btn-close"></button>
            </a>
        </div>
    </div>
    @if (Session::has('success'))
    <div
        class="alert alert-success alert-dismissible fade show"
        role="alert">
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
        ></button>
        <strong>{{Session::get('success')}}</strong>
    </div>
    
    <script>
        var alertList = document.querySelectorAll(".alert");
        alertList.forEach(function (alert) {
            new bootstrap.Alert(alert);
        });
    </script>
    
    @endif
    <!-- Options -->
    <div class="container-fluid mt-3">
        {{-- <form action=""> --}}
        <div class="d-flex flex-wrap flex-grow-1 gap-2">
            <div class="d-flex flex-grow-1">
                <input class="form-control" onchange="search()" type="text" name="search" id="search"
                    title="Search engine">
            </div>
            <div class="d-md-flex d-flex flex-grow-1 gap-2">
                <select class="form-select" name="filter" id="filter" title="Filter">
                    <option value="id">#</option>
                    <option value="ticket_id">Ticket</option>
                    <option value="name">Name</option>
                    <option value="email">Email</option>
                    <option value="no_telp">No. Telp</option>
                    <option value="amount">Amount</option>
                    <option value="total">Total</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="created_at">Bought Date</option>
                </select>
                <select class="form-select" name="sort" id="sort" title="Sort Order">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            </div>
        </div>
        {{-- </form> --}}
    </div>
    <!-- Table -->
    <div class="table-responsive mt-3">
        <table class="table table-striped" id="search_list">
            <thead>
                <tr>
                    <th scope="col" style="width: 4ch;">#</th>
                    <th scope="col" style="width: 20ch;">Ticket</th>
                    <th scope="col" style="width: 20ch;">User</th>
                    <th scope="col" style="width: 20ch;">Email</th>
                    <th scope="col">No Telp</th>
                    <th scope="col">Jumlah Beli</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Confirmed</th>
                    <th scope="col">Bought Date</th>
                    <th scope="col" style="width: 24ch;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td scope="row">{{ $transaction->id }}</td>
                        <td>{{ $transaction->fk_ticket_id->name}}</td>
                        <td>{{ $transaction->name }}</td>
                        <td>{{ $transaction->email }}</td>
                        <td>{{ $transaction->no_telp }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->total }}</td>
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
                        <td>{{ $transaction->created_at }}</td>
                        <td>
                            <form onsubmit="return confirm('Are you sure you want to delete this data?')"
                                action="{{ route('transactions.destroy', ['transaction' => $transaction]) }}"
                                method="POST">
                                <a href="{{ route('redeem', [
                                    'id' => $transaction,
                                    'code' => $transaction->code,
                                    'ticket' => $transaction->ticket_id,
                                    'user' => $transaction->user_id,
                                    'amount' => $transaction->amount,
                                    ]) }}"
                                {{-- <a href="{{ route('transactions.confirm', ['id' => $transaction]) }}" --}}
                                    class="text-decoration-none">
                                    <button type="button" class="btn btn-success mb-1"><i class="fas fa-check-circle"></i></button>
                                </a>
                                <a href="{{ route('transactions.show', ['transaction' => $transaction]) }}"
                                    class="text-decoration-none">
                                    <button type="button" class="btn btn-info mb-1"><i class="fas fa-eye"></i></button>
                                </a>
                                <a href="{{ route('transactions.edit', ['transaction' => $transaction]) }}"
                                    class="text-decoration-none">
                                    <button type="button" class="btn btn-warning mb-1"><i
                                            class="fas fa-edit"></i></button>
                                </a>
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger mb-1"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<script>
    function search() {
        var query = $('#search').val(); // Get search bar value
        var filter = $('#filter').val(); // Get selected filter value
        var sort = $('#sort').val(); // Get selected sort value
        $.ajax({ // Ajax script
            url: "{{ route('transactions.search') }}", // Route
            type: "GET", // Method
            data: {
                'search': query,
                filter,
                sort
            },
            success: function(data) { // If process has no error..
                $('#search_list').html(data); // Replace row display for data table
            }
        })
    }

    
</script>

</html>
