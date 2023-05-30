@extends('layout.app')

@section('title', 'Sign-Up | Y-Connect News')

@section('content')
<div class="bg-light border rounded shadow-lg m-auto mt-4 py-3 px-5" style="width: 22rem;">
  <h1 class="text-center mb-3">Sign Up</h1>
  @if (session('failed'))
  <div class="alert alert-danger mt-2" role="alert">
      <strong>{{ session('failed') }}</strong>
      <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @elseif (session('success'))
  <div class="alert alert-success" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <form action="" method="POST">
    @csrf
    <div class="form-floating mb-3">
      <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}" oninvalid="customValidationInput(this);" autofocus required>
      <label for="nama">Nama Lengkap</label>
      @error('nama')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <div class="form-floating mb-3">
      <input type="username" id="username" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" value="{{ old('username') }}" oninvalid="customValidationInput(this);" required="required">
      <label for="username">Username</label>
      @error('username')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <div class="form-floating mb-3">
      <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" oninvalid="customValidationInput(this);" required>
      <label for="email">Email</label>
      @error('email')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <div class="form-floating mb-3">
      <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" oninvalid="customValidationInput(this);" required>
      <label for="password">Password</label>
      @error('password')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <div class="form-floating mb-3">
      <input type="password" id="confpassword" name="confpassword" class="form-control @error('confpassword') is-invalid @enderror" placeholder="Confirm Password" oninvalid="customValidationInput(this);" required>
      <label for="confpassword">Confirm Password</label>
      @error('confpassword')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>
    
    <div class="row">
      <button type="submit" class="btn btn-primary mt-3 mb-2">Sign Up</button>
    </div>
  </form>
</div>
@endsection