@extends('layout.app')

@section('title', 'New Password | Y-Connect News')

@section('content')
<div class="row justify-content-center" style="height: 50vh;">
  <div class="col-lg-10 bg-light ps-4 pb-4 mt-5 rounded shadow">
    <h1 class="fs-3 mt-3">Create New Password</h1>
    <hr>
    @if( session('email') )
    <div class="alert alert-success mt-2 mx-3" role="alert">
      {{ session('email') }}
    </div>
    @endif
    <p class="">Please input your new password for this account!</p>
    <div class="col-lg-6">
      <form action="/reset-password" method="POST">
        @csrf
        <div class="form-floating mb-3">
          <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Account" oninvalid="customValidationInput(this)" value="{{ request()->query('email') }}" readonly>
          <label for="email">Email Account</label>
          @error('email')
          <div class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>

        <div class="form-floating mb-3">
          <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="New Password" oninvalid="customValidationInput(this)" value="{{ old('password') }}" autofocus required>
          <label for="password">New Password</label>
          @error('password')
          <div class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>

        <div class="form-floating mb-3">
          <input type="password" id="confpassword" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirm New Password" oninvalid="customValidationInput(this)" value="{{ old('password_confirmation') }}" autofocus required>
          <label for="confpassword">Confirm New Password</label>
          @error('password_confirmation')
          <div class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>
        <input type="hidden" name="token" value="{{ $token }}">
        <button type="submit" class="btn btn-success float-end">Change Password</button>
      </form>
    </div>
  </div>
</div>
@endsection