<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="{{ url('assets/images/y-logo.png') }}" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <title>@yield('title')</title>
</head>

<body>
  <div class="container">
    <div class="row text-center" style="height: 100vh;">
      <div class="col-12 align-self-center">
        <h1>@yield('code')</h1>
        <p class="fs-2">@yield('message')</p>
      </div>
    </div>
  </div>
</body>

</html>