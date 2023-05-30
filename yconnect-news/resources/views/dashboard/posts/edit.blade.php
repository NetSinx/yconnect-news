@extends('dashboard.layout.dashboard')

@section('myposts')
<p class="fs-2 m-0 mb-2">Edit Post</p>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb m-0">
    <li class="breadcrumb-item">
      <a href="/dashboard">Dashboard</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
      <a href="/dashboard/posts">Posts</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
    <form action="" method="POST" class="form" enctype="multipart/form-data">
      @method('PUT')
      @csrf
      @foreach( $posts as $post )
      <label for="title" class="form-label">Title :</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror mb-2" id="title" name="title" placeholder="Input post title..." value="{{ $post->title }}" oninvalid="customValidationInput(this)" autofocus required>
      @error('title')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror

      <label for="category" class="form-label">Category :</label>
      <select class="form-select @error('category') is-invalid @enderror mb-2" name="category" oninvalid="customValidationInput(this)" required>
        <option selected value="{{ $post->category->id }}">{{ $post->category->name }}</option>
        <option value="{{ $post->category->id }}">{{ $post->category->name }}</option>
      </select>
      @error('category')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror

      <label for="image" class="form-label d-block">Upload image :</label>
      <img src="{{ url('storage/' . $post->image) }}" class="mb-3 imgPreview" width="30%">
      <input class="form-control @error('image') is-invalid @enderror mb-2" name="image" type="file" id="image" oninvalid="customValidationInput(this)" onchange="readImage()" required>
      @error('image')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror

      <label class="form-label">Content :</label>
      <input type="hidden" name="content">
      <div class="editor form-control @error('content') is-invalid @enderror">
        {!! $post->content !!}
      </div>
      @endforeach
      @error('content')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror

      <button type="submit" class="btn btn-success float-end my-3">Update Post</button>
    </form>
  </div>
</div>
@endsection