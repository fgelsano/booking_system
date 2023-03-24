@extends('layouts.front.auth')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4 my-5">
            <div class="text-center">
                <a href="/">
                    <img src="{{ asset('assets/logo/rec/clr-25.png') }}" alt="" srcset="">
                </a>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                  <p class="login-box-msg">Reset Password</p>
            
                  <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email address">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row mb-0">
                        <div class="">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </div>
                  </form>
                  @if(session('status'))
                    <div class="alert alert-success mt-3">
                            {{ session('status') }}
                    </div>
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
