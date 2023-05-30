@extends('dashboard.layout.dashboard')

@section('mydashboard')
<p class="fs-2 m-0 mb-2">My Dashboard</p>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb m-0">
    <li class="breadcrumb-item active">Dashboard</li>
  </ol>
</nav>
<hr>
<div class="row">
  <div class="row justify-content-center">
    <div class="col-md-5 col-lg-5">
      <div class="card mb-4 text-center">
        <div class="card-body bg-primary bg-opacity-75 text-white">
          <i class="bi bi-newspaper card-title text-body-tertiary float-end" style="font-size: 8rem;"></i>
          <div class="card-text float-start mt-5">
            <h1>{{ count($myposts) }}</h1>
            <p>Postingan</p>
          </div>
        </div>
        <div class="card-header bg-primary p-0">
          <a class="text-decoration-none link-light" href="/dashboard/posts">Lihat Selengkapnya <i class="bi bi-arrow-right-circle-fill fs-4 align-middle"></i></a>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-lg-5">
      <div class="card text-center">
        <div class="card-body bg-success text-white bg-opacity-75">
          <i class="bi bi-tags-fill card-title text-body-tertiary float-end" style="font-size: 8rem;"></i>
          <div class="card-text float-start mt-5">
            <h1>{{ count($mycategories) }}</h1>
            <p>Category</p>
          </div>
        </div>
        <div class="card-header bg-success p-0">
          <a class="text-decoration-none link-light" href="/dashboard/categories">Lihat Selengkapnya <i class="bi bi-arrow-right-circle-fill fs-4 align-middle"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection