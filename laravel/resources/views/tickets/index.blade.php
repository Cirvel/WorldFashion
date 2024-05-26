<!DOCTYPE html>

<html lang="en" data-bs-theme="auto">

<head>
    <title>Tickets</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<!-- Body -->

<body class="m-2">
    <div class="mb-3 d-flex">
        <h3 class="form-label">TICKETS</h3>
        <div class="ms-auto">
            <a href="{{ route('dashboard.admin') }}">
                <button type="button" class="btn btn-close"></button>
            </a>
        </div>
    </div>
    @if (Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
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
                    <option value="name">Name</option>
                    <option value="price">Price</option>
                    <option value="stock">Stock</option>
                </select>
                <select class="form-select" name="sort" id="sort" title="Sort Order">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
                <a href="{{ route('tickets.create') }}">
                    <button type="button" class="btn btn-outline-success text-nowrap ms-2"><i
                            class="fa fa-plus"></i><span class="d-none d-md-inline"> Add Ticket</span></button>
                </a>
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
                    <th scope="col">Title</th>
                    <th scope="col" style="width: 20ch;">Price</th>
                    <th scope="col" style="width: 20ch;">Stock</th>
                    <th scope="col" style="width: 15ch;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td scope="row">{{ $ticket->id }}</td>
                        <td>{{ $ticket->name }}</td>
                        <td>{{ $ticket->price }}</td>
                        <td>{{ $ticket->stock }}</td>
                        <td>
                            <form onsubmit="return confirm('Are you sure you want to delete this data?')"
                                action="{{ route('tickets.destroy', ['ticket' => $ticket]) }}" method="POST">
                                <a href="{{ route('tickets.edit', ['ticket' => $ticket]) }}"
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
            url: "{{ route('tickets.search') }}", // Route
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
