@extends('dashboard.layout.dashboard')

@section('mycategories')
<p class="fs-2 m-0 mb-2">My Categories</p>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb m-0">
    <li class="breadcrumb-item">
      <a href="/dashboard">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Categories</li>
  </ol>
</nav>
<hr>

<div class="row justify-content-center">
  <div class="col-lg-12">
    @if( session('success') )
    <div class="alert alert-success mx-3" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
  </div>

  <div class="add-post d-flex justify-content-end p-0 mb-3">
    <a class="btn btn-primary me-4" href="/dashboard/categories/create">Create Category <i class="bi bi-plus-circle ms-1"></i></a>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered border-dark text-center">
      @if( count($categories) > 0 )
      <tr>
        <th>No.</th>
        <th>Category Name</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Actions</th>
      </tr>
      @foreach($categories as $category)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $category->name }}</td>
        <td>{{ $category->created_at->diffForHumans() }}</td>
        <td>{{ $category->updated_at->diffForHumans() }}</td>
        <td>
          <a href="/dashboard/categories/edit/{{ $category->slug }}" class="btn btn-sm btn-warning">Edit</a>
          <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $category->slug }}">
            Delete
          </button>

          <form action="/dashboard/categories/delete/{{ $category->slug }}" class="d-inline-block" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal fade" id="staticBackdrop{{ $category->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-body text-center">
                    <p class="fs-3">Are you sure want to delete?</p>
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
      @else
      <p class="fs-3 text-center">No Categories found. Please click 'Create Category' to create new category!</p>
      @endif
    </table>
  </div>
</div>
@endsection