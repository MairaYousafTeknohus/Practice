<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <style>
        </style>
    </head>
    <body class="py-4 container">
      @if (Route::has('register'))
      <h2>
        <a class="nav-link color-success" href="{{ route('register')}}">Register →</a>
      </h2>
      @endif
      @if(Session::has('error'))
      <div class="alert alert-danger" role="alert">
          {{ Session::get('error') }}
      </div>
      @endif
        <div class="d-flex align-items-center py-4">
            <div class="form-signin w-50 m-auto">
                <form class="my-3" method="post" action="{{ route('login_test')}}">
                  <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
                  @csrf
                  <div class="form-floating my-5">
                    <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                  </div>
                  <div class="form-floating my-5">
                    <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                  </div>
                  <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
                </form>
            </div>
        </div>
       

    </body>
</html>
