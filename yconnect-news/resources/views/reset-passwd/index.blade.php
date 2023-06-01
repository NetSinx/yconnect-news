@extends('layout.app')

@section('title', 'Reset Password | Y-Connect News')

@section('content')
<div class="row justify-content-center" style="height: 50vh;">
  <div class="col-lg-10 bg-light ps-4 pb-4 mt-5 rounded shadow">
    <h1 class="fs-3 mt-3">Send Email Account to Reset Password</h1>
    <hr>
    @if( session('status') )
    <div class="alert alert-success mt-2 mx-3" role="alert">
      {{ session('status') }}
      <button type="button" data-bs-dismiss="alert" class="btn-close float-end" aria-label="close"></button>
    </div>
    @endif
    <p class="">Please input your email that your using for reset password that account!</p>
    <div class="col-lg-6">
      <form action="" method="POST">
        @csrf
        <div class="form-floating mb-3">
          <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Account" oninvalid="customValidationInput(this)" value="{{ old('email') }}" autofocus required>
          <label for="email">Email Account</label>
          @error('email')
          <div class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>
        <button type="submit" class="btn btn-danger float-end">Send Link Reset Password</button>
      </form>
    </div>
  </div>
</div>
@endsection