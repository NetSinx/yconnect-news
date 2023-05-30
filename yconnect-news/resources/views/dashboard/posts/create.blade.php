@extends('dashboard.layout.dashboard')

@section('myposts')
<p class="fs-2 m-0 mb-2">Add Post</p>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb m-0">
    <li class="breadcrumb-item">
      <a href="/dashboard">Dashboard</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
      <a href="/dashboard/posts">Posts</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
  </ol>
</nav>
<hr>
@if( session('failed') )
<div class="alert alert-danger mt-2 mx-3" role="alert">
  {{ session('failed') }}
  <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row ms-2">
  <div class="col-md-8 col-lg-9">
    <form action="" method="POST" enctype="multipart/form-data">
      @csrf
      <label for="title" class="form-label">Title :</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror mb-2" id="title" name="title" placeholder="Input post title..." value="{{ old('title') }}" autofocus required oninvalid="customValidationInput(this)">
      @error('title')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror

      <label for="category" class="form-label">Category :</label>
      <select class="form-select @error('category') is-invalid @enderror" name="category" oninvalid="customValidationInput(this)" required>
        @if( count($categories) > 0 )
        <option selected>Choose category...</option>
        @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
        @else
        <option selected>Choose category...</option>
        @endif
      </select>
      @error('category')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror

      <label for="image" class="form-label mt-2">Upload image :</label>
      <img src="" class="mb-3 imgPreview" width="30%">
      <input class="form-control @error('image') is-invalid @enderror mb-2" name="image" type="file" id="image" oninvalid="customValidationInput(this)" onchange="readImage()" required>
      @error('image')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror

      <label class="form-label">Content :</label>
      <input type="hidden" name="content">
      <div class="editor form-control @error('content') is-invalid @enderror" style="height: 150px;"></div>
      @error('content')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror

      <button type="submit" class="btn btn-success float-end mt-3 mb-3">Send Post</button>
    </form>
  </div>
</div>
@endsection