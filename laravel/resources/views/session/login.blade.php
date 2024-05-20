<!DOCTYPE html>

<html lang="en">
    <head>
        <title>World Fashion</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <body>
        <div class="mb-md-3"></div>
        <div class="container-md form-control mx-auto mb-md-3">
            <form class="" method="post" action="/login">
                @csrf
                <div class="mb-3">
                    <h3 class="form-label">LOGIN</h3>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Username</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="mb-2">
                    <input class="btn btn-success" type="submit" value="Login">
                </div>
            </form>
        </div>
    </body>
    <footer>
        
    </footer>
</html>