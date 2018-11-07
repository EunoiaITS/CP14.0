@extends('frontend.layout')
@section('content')
    <!-- sign in page -->
    <div class="get-offer-ride">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 sign-in-get-ad padding-left-o padding-right-o">
                    <h3 class="get-popular-list">Contact</h3>
                    <h3 class="highlight">With Us.</h3>
                </div>
                <div class="col-sm-12 clearfix">
                    @include('frontend.includes.messages')
                    @if(isset($errors))
                        @foreach($errors as $error)
                            <p class="alert alert-danger">
                                {{ $error }}
                            </p>
                        @endforeach
                    @endif
                </div>
                <!-- search result page -->
                <div class="col-sm-8 col-xs-12">
                    <form action="{{ url('/contact-us') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input name="name" type="text" class="form-control" placeholder="Your Full Name" required="required">
                        </div>
                        <div class="form-group">
                            <input name="email" type="email" class="form-control" placeholder="Your Email" required="required">
                        </div>
                        <div class="form-group">
                            <textarea name="message" cols="30" rows="7" class="form-control" placeholder="Message" required="required"></textarea>
                        </div>
                        <div class="sign-in-option-get">
                            <button type="submit" class="btn btn-info btn-offer">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end signin page -->

@endsection