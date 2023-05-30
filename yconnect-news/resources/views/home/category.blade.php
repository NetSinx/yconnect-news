@extends('home.layout.app')

@section('title', 'Home | Y-Connect News')

@section('content')
<h1 class="text-center my-4">All Posts by Category</h1>

<div class="row mb-5 justify-content-center">
  <div class="col-lg-6">
    <form method="GET">
      <div class="input-group">
        <input class="form-control" name="search" type="search" value="{{ request('search') }}" placeholder="Search..." autofocus>
        <button class="btn btn-primary" type="submit">Search</button>
      </div>
    </form>
  </div>
</div>

@if (count($posts))
<div class="card mb-3">
  <img src="{{ url('storage/' . $posts[0]->image) }}" height="500" class="card-img-top">
  <div class="card-body">
    <h1 class="card-title">{{ $posts[0]->title }}</h1>
    <p class="card-text">
      {!! $posts[0]->excerpt !!}
    </p>
    <small class="d-block text-body-secondary">Posted by <a href="/post/creator/{{ $posts[0]->user->slug }}">{{ $posts[0]->user->name }}</a> in <a href="/post/category/{{ $posts[0]->category->slug }}">{{ $posts[0]->category->name }}</a></small>
    <small class="text-body-secondary d-block">Last created {{ $posts[0]->created_at->diffForHumans() }}</small>
    <a href="/post/{{ $posts[0]->slug }}" class="btn btn-primary mt-3">Lihat Postingan</a>
  </div>
</div>

<div class="row">
  @foreach ($posts->skip(1) as $post)
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card">
      <img src="{{ url('storage/' . $post->image) }}" class="card-img-top">
      <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-text">
          {!! $post->excerpt !!}
        </p>
        <small class="d-block text-body-secondary">Posted by <a href="/post/creator/{{ $post->user->slug }}">{{ $post->user->name }}</a> in <a href="/post/category/{{ $post->category->slug }}">{{ $post->category->name }}</a>
        </small>
        <small class="text-body-secondary d-block">Last created {{ $post->created_at->diffForHumans() }}</small>
        <a href="/post/{{ $post->slug }}" class="btn btn-primary mt-3">Lihat Postingan</a>
      </div>
    </div>
  </div>
  @endforeach
</div>
@else
<p class="text-center fs-3">No Post Found</p>
@endif
@endsection