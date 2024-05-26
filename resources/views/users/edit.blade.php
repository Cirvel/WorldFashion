<!DOCTYPE html>

<html lang="en" data-bs-theme="auto">
    <head>
        <title>Users</title>    
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
    <div class="container-md form-control mx-auto p-2">
        <form class="" method="POST" action="{{ route('users.update',$user->id) }}">
            @csrf
            @method('put')
            <div class="mb-3 d-flex">
                <h3 class="form-label">EDIT USER</h3>
                <div class="ms-auto">
                    <a href="/users">
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
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name"
                title="Original value: {{ $user->name }}"
                value="{{ $user->name }}"
                required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="example123@here.com"
                title="Original value: {{ $user->email }}"
                value="{{ $user->email }}"
                required>
            </div>
            <div class="mb-3">
                <select name="level" id="level" class="form-select">
                    <option value="user" selected>User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            
            <div>
                <button class="btn btn-success d-md-inline d-none" type="submit">Submit</button>
                <button class="btn btn-success d-md-none d-inline" type="submit"><i class="fas fa-check"></i></button>
                <button class="btn btn-danger d-md-inline d-none" type="reset">Clear</button>
                <button class="btn btn-danger d-md-none d-inline" type="reset"><i class="fas fa-trash"></i></button>
            </div>
        </form>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

</html>