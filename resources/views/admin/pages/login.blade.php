@extends('frontend.admin-layout')
@section('content')
    <!-- sign in page -->
    <div class="get-offer-ride">
        <div class="container">
            <div class="row">
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="col-sm-12 sign-in-get-ad padding-left-o padding-right-o">
                    <h3 class="get-popular-list">Welcome</h3>
                    <h3 class="highlight">Admin</h3>
                </div>
                <!-- search result page -->
                <div class="col-sm-8 col-xs-12">
                    <form method="post" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input id="password" placeholder="Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                        </span>
                            @endif
                        </div>
                        <ul class="remember-me clearfix">
                            <li>
                                <div class="remember-me-option">
                                    <input type="checkbox" id="checkbox1" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="checkbox1">Remember Me</label>
                                </div>
                            </li>
                        </ul>
                        <div class="sign-in-option-get">
                            <button class="btn btn-info btn-offer" type="submit" >Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
