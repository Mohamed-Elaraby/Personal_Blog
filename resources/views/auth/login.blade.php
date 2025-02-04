@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card p-4">
            <div class="card-header text-center text-uppercase h4 font-weight-light">
                Login
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="card-body py-5">
                    <div class="form-group">
                        <label class="form-control-label">{{ __('E-Mail Address') }}</label>
                        <input type="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-group">
                        <label class="form-control-label">{{ __('Password') }}</label>
                        <input type="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="custom-control custom-checkbox mt-4">
                        <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">Remember</label>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary px-5">Login</button>
                        </div>

                        <div class="col-6">
                            <a href="{{ route('password.request') }}" class="btn btn-link">Forgot Your Password?</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
