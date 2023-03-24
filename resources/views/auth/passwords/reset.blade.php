@extends('layouts.front.auth')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center my-5">
        <div class="col-md-6 my-5">
            <div class="text-center">
              <img src="{{ asset('assets/logo/rec/clr-25.png') }}" alt="" srcset="">
            </div>
            <div class="card my-5">
                <div class="card-header">{{ __('Reset Password') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="input-group mb-3">
                          <!-- <input type="email" class="form-control" placeholder="Email"> -->
                          <input id="email" type="email" placeholder="Your email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ request('email') }}" required autocomplete="email" hidden>
                        </div>
                        <div class="input-group mb-3">
                          <!-- <input type="password" class="form-control" placeholder="Password"> -->
                          <input id="password" type="password" placeholder="Your password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                            </div>
                          </div>
                          @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="input-group mb-3">
                          <!-- <input type="password" class="form-control" placeholder="Retype password"> -->
                          <input id="password-confirm" placeholder="Confirm password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                            </div>
                          </div>
                          
                        </div>
                        <div class="row">
                          <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Reset</button>
                          </div>                          
                        </div>
                        @error('email')
                          <div class="alert alert-danger mt-3">
                              {{ $message }}
                          </div>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection