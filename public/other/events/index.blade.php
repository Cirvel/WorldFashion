<!DOCTYPE html>

<html lang="en" data-bs-theme="auto">
    <head>
        <title>Events</title>    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <script src="{{asset('js/myjs.js')}}"></script>
    
        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    
    <!-- Body -->
    <body class="m-2">
        <div class="mb-3 d-flex">
            <h3 class="form-label">EVENTS</h3>
            <div class="ms-auto">
                <a href="{{ route('dashboard.admin') }}">
                    <button type="button" class="btn btn-close"></button>
                </a>
            </div>
        </div>
    <!-- Options -->
    <div class="container-fluid mt-3">
        {{-- <form action=""> --}}
            <div class="d-flex flex-wrap flex-grow-1 gap-2">
                <div class="d-flex flex-grow-1">
                    <input class="form-control" type="text" name="search" id="search" title="Search engine">
                    <button type="submit" class="btn btn-info ms-2" name="search-button" id="search-button"><i class="fas fa-search"></i></button>
                </div>
                <div class="d-md-flex d-flex flex-grow-1 gap-2">
                    <select class="form-select" name="filter" id="filter" title="Filter">
                        <option value="event_id">#</option>
                        <option value="title">Title</option>
                        <option value="place">Place</option>
                        <option value="description">Description</option>
                        <option value="location">Location</option>
                    </select>
                    <select class="form-select" name="sort" id="sort" title="Sort Order">
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                    <a href="{{ route('events.create') }}">
                        <button type="button" class="btn btn-outline-success text-nowrap ms-2"><i class="fa fa-plus"></i><span class="d-none d-md-inline"> Add Event</span></button>
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
                    <th scope="col" style="width: 20ch;">Title</th>
                    <th scope="col">Place</th>
                    <th scope="col">Description</th>
                    <th scope="col" style="width: 12ch;">End Date</th>
                    <th scope="col" style="width: 12ch;">Start Date</th>
                    <th scope="col">Location</th>
                    <th scope="col" style="width: 15ch;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $events as $event )
                    <tr>
                        <td scope="row">{{ $event->event_id }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->place }}</td>
                        <td>{{ $event->description }}</td>
                        <td>{{ $event->start_date }}</td>
                        <td>{{ $event->end_date }}</td>
                        <td>{{ $event->location }}</td>
                        <td>
                            <form onsubmit="return confirm('Are you sure you want to delete this data?')" action="{{ route('events.destroy', ['event' => $event]) }}" method="POST">
                                <a href="{{ route('events.edit', ['event' => $event]) }}" class="text-decoration-none">
                                    <button type="button" class="btn btn-warning mb-1"><i class="fas fa-edit"></i></button>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<script>
    $(document).ready(function(){
        $('#search-button').on('click',function(){
            var query = $('#search').val(); // Get search bar value
            var filter = $('#filter').val(); // Get selected filter value
            var sort = $('#sort').val(); // Get selected sort value
            $.ajax({ // Ajax script
                url: "{{ route('events.search') }}", // Route
                type: "GET", // Method
                data: {'search':query,filter,sort}, 
                success:function(data){ // If process has no error..
                    $('#search_list').html(data); // Replace row display for data table
                }
            })
        })
    })
</script>

</html>