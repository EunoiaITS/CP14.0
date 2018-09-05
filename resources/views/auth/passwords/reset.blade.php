@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-sm-8">
            <div class="forget-password-ex">
                <form method="POST" action="{{ route('password.request') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    <h2 class="highlight new-hightlight">Reset Password</h2>
                    <div class="form-group">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="Enter Your Email Address" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Enter Your Password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Re-Type Your Password" required>
                    </div>
                    <div class="sign-in-option-get clearfix">
                        <button type="submit" class="btn btn-info btn-offer">Submit</button>
                        <a class="btn btn-info btn-offer btn-cancel" href="#">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
