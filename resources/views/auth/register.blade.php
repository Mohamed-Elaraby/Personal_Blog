@extends('layouts.auth')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card p-4">
            <div class="card-header text-center text-uppercase h4 font-weight-light">
                Register
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="card-body py-5">
                    <div class="form-group">
                        <label for="name" class="form-control-label">Name</label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-group">
                        <label for="email" class="form-control-label">E-Mail Address</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-group">
                        <label for="password" class="form-control-label">Password</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="form-control-label">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-block">Create Account</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
