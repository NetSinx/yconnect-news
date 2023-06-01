@extends('layout.app')

@section('title', 'Sign-In | Y-Connect News')

@section('content')
<div class="row justify-content-center align-content-center" style="height: 90vh;">
  <div class="col-sm-5 col-lg-4">
    <div class="bg-light border rounded shadow-lg mx-auto mb-4 pb-5 pt-3">
      <div class="text-center">
        <img src="{{ url('assets/images/y-logo.png') }}" width="70">
      </div>
      <p class="fs-3 text-center">Y-Connect Admin</p>

      @if (session('failed'))
      <div class="alert alert-danger mt-2 mx-3" role="alert">
        {{ session('failed') }}
        <button type="button" data-bs-dismiss="alert" class="btn-close float-end" aria-label="close"></button>
      </div>
      @elseif (session('success'))
      <div class="alert alert-success mt-2 mx-3" role="alert">
        {{ session('success') }}
        <button type="button" data-bs-dismiss="alert" class="btn-close float-end" aria-label="close"></button>
      </div>
      @endif

      @if( session('retries') )
      <div class="alert alert-danger mt-0 mx-3" role="alert">
        {{ session('retries') }}
      </div>
      @endif

      <form action="" method="POST" class="px-5">
        @csrf
        <div class="form-floating mb-3">
          <input type="username" id="username" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Email/Username" oninvalid="customValidationInput(this)" value="{{ old('username') }}" autofocus required>
          <label for="username">Email/Username</label>
          @error('username')
          <div class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>

        <div class="form-floating mb-5">
          <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" oninvalid="customValidationInput(this)" placeholder="Password" required>
          <label for="password">Password</label>
          @error('password')
          <div class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>

        <div class="row">
          <button class="btn btn-primary mb-3">Login</button>
          @if( session('retries') )
          <p class="text-center"><a href="/forgot-password">Lupa Password</a></p>
          @endif
          <p>Tidak punya akun? <a href="/sign-up">Daftar</a></p>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection