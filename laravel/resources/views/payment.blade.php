<!DOCTYPE html>

<html lang="en" data-bs-theme="auto">
    <head>
        <title>Payment</title>    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <script src="{{asset('js/myjs.js')}}"></script>
    
        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    
    <body class="m-2">
    <!-- Body -->
    <div class="mb-3"></div>
    <div id="post" class="card">
        <div class="card-header">
            <p> </p>
        </div>

        <div class="card-body offcanvas-bottom d-flex">
            <div class="me-1">
                {{ $qr_code }}
            </div>
            <div class="container-fluid">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>{{ "Nil" }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ "Nil@nil.com" }}</td>
                        </tr>
                        <tr>
                            <td>No. Telp</td>
                            <td>{{ "1234-567-890" }}</td>
                        </tr>
                        <tr>
                            <td>Amount</td>
                            <td>{{ "3" }}</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>{{ "300000" }}</td>
                        </tr>
                        <tr>
                            <td>Confirmed</td>
                            <td>{{ "true" }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div title="Date Posted: YYYY-MM-DD" class="card-footer offcanvas-bottom d-flex">
            <div class="ms-0">
                <h6><i class="fa fa-calendar"></i>25-02-2024</h6>
            </div>
            <div class="ms-auto">
                <!-- <button class="btn btn-warning">Edit</button>
                <button class="btn btn-danger">Delete</button> -->
                <div class="dropdown">
                    <button button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis"></i></button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#" class="dropdown-item link-body-emphasis bg-danger-subtle">Report</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

</html>