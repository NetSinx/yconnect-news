@extends('home.layout.app')

@foreach($posts as $post)
@section('title', $post->title)

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb mt-4">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Post</li>
  </ol>
</nav>

<h1 class="text-center">{{ $post->title }}</h1>

<p class="text-body-secondary text-center">
  {{ $post->created_at->isoFormat('dddd, D/MM/Y') }} | Posted by : {{ $post->user->name }} | {{ $post->category->name }}
</p>
<hr>
<div class="row justify-content-center">
  <img src="{{ url('storage/' . $post->image) }}" height="480px">
</div>
<div class="content-post mt-3">
  <p>{!!$post->content!!}</p>
</div>
@endforeach
@endsection