@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-sm-8">
            <div class="forget-password-ex">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                    <h2 class="highlight">Forget Password</h2>
                    <p>Simply Enter Your Email to Reset Your Password.</p>
                    <div class="form-group">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
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
