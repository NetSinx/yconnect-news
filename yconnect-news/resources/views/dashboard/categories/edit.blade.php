@extends('dashboard.layout.dashboard')

@section('mycategories')
<p class="fs-2 m-0 mb-2">Edit Category</p>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb m-0">
    <li class="breadcrumb-item">
      <a href="/dashboard">Dashboard</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
      <a href="/dashboard/categories">Categories</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
  </ol>
</nav>
<hr>
@if( session('failed') )
<div class="col-lg-12">
  <div class="alert alert-danger mt-2 mx-3" role="alert">
    {{ session('failed') }}
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
</div>
@endif

<div class="col-sm-8 col-md-9 col-lg-6 ms-4">
  @foreach($categories as $category)
  <form action="" method="POST">
    @method('PUT')
    @csrf
    <label for="title" class="form-label">Category Name :</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror mb-2" id="title" name="name" placeholder="Please input category name..." value="{{ $category->name }}" autofocus required oninvalid="customValidationInput(this)">
    @error('name')
    <div class="invalid-feedback">
      {{$message}}
    </div>
    @enderror
    @endforeach

    <button type="submit" class="btn float-end btn-success mt-3">Send Category</button>
  </form>
</div>
@endsection