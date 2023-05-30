<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="{{ url('assets/images/y-logo.png') }}" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ url('assets/css/hamburgers.css') }}">
  <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
  <title>Dashboard | Y-Connect</title>
</head>

<body>
  <nav class="navbar navbar-expand bg-primary navbar-dark shadow sticky-top p-0">
    <div class="container">
      <button class="hamburger hamburger--slider" type="button">
        <span class="hamburger-box">
          <span class="hamburger-inner"></span>
        </span>
      </button>
      <a class="navbar-brand me-auto ms-3" href="/">
        <img src="{{ url('assets/images/y-logo.png') }}" width="40" class="d-inline-block align-text-center">
        Y-Connect
      </a>
      <button type="button" class="border-0 bg-transparent me-2" id="btn-search"><i class="bi bi-search text-white fs-4"></i></button>
      <form class="d-flex" role="search">
        <input class="form-control" type="search" name="search" placeholder="Search..." aria-label="Search" value="{{ request('search') }}">
        <button class="btn btn-success" type="submit">Search</button>
      </form>
      <button type="button" id="notifications" class="position-relative border-0 bg-transparent me-4">
        <i class="bi bi-bell-fill fs-4 text-white"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
          99+
          <span class="visually-hidden">unread messages</span>
        </span>
      </button>
      <button type="button" id="chats" class="position-relative border-0 bg-transparent me-3">
        <i class="bi bi-chat-right-text-fill fs-4 text-white"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
          99+
          <span class="visually-hidden">unread messages</span>
        </span>
      </button>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 col-lg-2 bg-dark pe-4 shadow active inactive-phone" id="sidebar">
        <ul class="nav flex-column">
          <li class="nav-item py-2">
            <a class="nav-link dashboard {{ Request::is('dashboard') ? 'active' : '' }} py-2" aria-current="page" href="#dashboard"><i class="bi bi-layout-text-sidebar-reverse me-2 fs-5"></i> Dashboard</a>
          </li>
          <li class="nav-item py-2">
            <a class="nav-link py-2 posts {{ Request::is('dashboard/posts*') ? 'active' : '' }}" href="#posts"><i class="bi bi-stickies-fill me-2 fs-5"></i> Post</a>
          </li>
          <li class="nav-item py-2">
            <a class="nav-link py-2 category {{ Request::is('dashboard/categories*') ? 'active' : '' }}" href="#categories"><i class="bi bi-tags-fill me-2 fs-5"></i> Category</a>
          </li>
          <li class="nav-item py-2" id="notifications">
            <a class="nav-link py-2" href="#"><i class="bi bi-bell-fill me-2 fs-5"></i> Notifications</a>
          </li>
          <li class="nav-item py-2" id="chats">
            <a class="nav-link py-2" href="#"><i class="bi bi-chat-right-text-fill me-2 fs-5"></i> Chats</a>
          </li>
        </ul>
        <hr class="text-white sidebar" style="position: relative; bottom: -320px;">
        <div class="dropdown mb-3">
          <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ url('assets/images/y-logo.png') }}" width="40" class="rounded-circle me-2">
            <strong>{{ auth()->user()->username }}</strong>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li>
              <form action="/dashboard/sign-out" method="POST">
                @csrf
                <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-left me-1"></i> Sign out</button>
              </form>
            </li>
          </ul>
        </div>
      </div>

      <div class="col-md-9 col-lg-10 p-0 pt-2 active inactive-phone" id="dashboard" style="width: 80%;">
        @yield('mydashboard')

        @yield('myposts')

        @yield('mycategories')
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script type="text/javascript" src="{{ url('assets/js/script.js') }}"></script>
  <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
  <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
  <script>
    var quill = new Quill(".editor", {
      theme: "snow",
      modules: {
        toolbar: [
          [{
            header: [1, 2, 3, 4, 5, 6, false]
          }],
          [{
            font: []
          }],
          ["bold", "italic"],
          ["link", "blockquote", "code-block", "image"],
          [{
            list: "ordered"
          }, {
            list: "bullet"
          }],
          [{
            script: "sub"
          }, {
            script: "super"
          }],
          [{
            color: []
          }, {
            background: []
          }],
        ]
      }
    });

    quill.on('text-change', function() {
      document.querySelector("input[name='content']").value = quill.root.innerHTML;
    });

    const form = document.querySelector('.form');
    form.addEventListener('submit', () => {
      const content = document.querySelector("input[name='content']");
      content.value.innerHTML = quill.getText();
    });
  </script>
</body>

</html>