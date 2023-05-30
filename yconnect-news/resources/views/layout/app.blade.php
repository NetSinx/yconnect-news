<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="{{ url('assets/images/y-logo.png') }}" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/4505de1a69.js" crossorigin="anonymous"></script>
  <title>@yield('title')</title>
</head>

<body style="height: 100vh; background-color: #eaeaea;">
  <nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow sticky-top">
    <div class="container">
      <a class="navbar-brand" href="/">
        <img src="{{ asset('assets/images/y-logo.png') }}" style="width: 30px;">
        Y-Connect
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-4">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
        @if( !Request::is('sign-in') )
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="/sign-in"><i class="fa-solid fa-right-to-bracket" style="margin-right: 3px;"></i> Login</a>
          </li>
        </ul>
        @else
        @endif
      </div>
    </div>
  </nav>

  <div class="container">
    @yield('content')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="{{ url('assets/js/script.js') }}"></script>
</body>

</html>