@extends('dashboard.layout.dashboard')

@section('myposts')
<p class="fs-2 m-0 mb-2">My Posts</p>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb m-0">
    <li class="breadcrumb-item">
      <a href="/dashboard">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Posts</li>
  </ol>
</nav>
<hr>
<div class="col-lg-12">
  @if( session('success') )
  <div class="alert alert-success mt-2 mx-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
</div>

<div class="add-post d-flex justify-content-end p-0 mb-3">
  <a class="btn btn-primary me-4" href="/dashboard/posts/create">Create Post <i class="bi bi-plus-circle ms-1"></i></a>
</div>

@if( count($posts) > 0 )
<div class="table-responsive">
  <table class="table table-bordered border-dark text-center">
    <tr>
      <th>No.</th>
      <th>Title</th>
      <th>Category</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Actions</th>
    </tr>
    @foreach( $posts as $post )
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $post->title }}</td>
      <td>{{ $post->category->name }}</td>
      <td>{{ $post->created_at->diffForHumans() }}</td>
      <td>{{ $post->updated_at->diffForHumans() }}</td>
      <td>
        <a class="btn btn-sm btn-warning" href="/dashboard/posts/edit/{{ $post->slug }}">Edit</a>
        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $post->id }}">
          Delete
        </button>

        <form action="/dashboard/posts/delete/{{ $post->slug }}" method="POST">
          @method('DELETE')
          @csrf
          <div class="modal fade" id="staticBackdrop{{ $post->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-body">
                  <h2 class="text-center fs-3">Are you sure want to delete ?</h2>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                  <button type="submit" class="btn btn-danger">Yes</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </td>
    </tr>
    @endforeach
  </table>
</div>
@else
<p class="fs-3 text-center">No post found. Please click 'Create Post' to create new post!</p>
@endif
@endsection