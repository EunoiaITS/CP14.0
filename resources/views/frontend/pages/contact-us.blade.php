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
                <!-- search result page -->
                <div class="col-sm-8 col-xs-12">
                    <form action="#">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Your Full Name" required="required">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Your Email" required="required">
                        </div>
                        <div class="form-group">
                            <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit." required="required"></textarea>
                        </div>
                        <div class="sign-in-option-get">
                            <button class="btn btn-info btn-offer">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end signin page -->

@endsection