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
                  <p class="login-box-msg">Sign in to start your session</p>
            
                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                      <!-- <input type="email" class="form-control" placeholder="Email"> -->
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-envelope"></span>
                        </div>
                      </div>
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="input-group mb-3">
                      <!-- <input type="password" class="form-control" placeholder="Password"> -->
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
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
                    <div class="row">
                      <div class="col-8">
                        <div class="icheck-primary">
                          <!-- <input type="checkbox" id="remember"> -->
                          <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                          <label for="remember">
                            Remember Me
                          </label>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                      </div>
                      <!-- /.col -->
                    </div>
                  </form>
            
                  <!-- /.social-auth-links -->
            
                  <p class="mb-1">
                    <a href="{{ route('password.request') }}">I forgot my password</a>
                  </p>
                  <p class="mb-0">
                    <a href="/register" class="text-center">Register a new membership</a>
                  </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
</div>
@endsection
