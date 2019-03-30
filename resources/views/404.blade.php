<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@if(isset($error)){{ $error }}@endif | Not found! - carhailing</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- stylesheet css -->
    <link rel="stylesheet" href="{{ asset('public/assets/frontend/css/fontawesome-all.min.css') }}">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('public/assets/frontend/css/bootstrap.min.css') }}">
    <!-- bootstrap select -->
    <link rel="stylesheet" href="{{ asset('public/assets/frontend/css/bootstrap-select.css') }}">
    <!-- bootstrap date time picker -->
    <link rel="stylesheet" href="{{ asset('public/assets/frontend/css/bootstrap-datetimepicker.css') }}">    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('public/assets/frontend/css/style.css') }}">
    <!-- mordernizr css -->
    <script src="{{ asset('public/assets/frontend/js/vendor/modernizr.custom.97074.js') }}"></script>
</head>
<body>

<div class="wrapper">
    <div class="not-found text-center">
        <h4>oops!</h4>
        <h3>We can't seem to find the page you are looking for.</h3>
        <p><b>Error @if(isset($error)){{ $error }}@endif</b></p>
        <p>Go Back <a href="{{ url('/') }}">carhailing.com</a></p>
    </div>
</div>


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- main js file -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>window.jQuery || document.write('<script src="{{ asset('public/assets/frontend/js/vendor/jquery-3.2.1.min.js') }}"><\/script>')</script>
<!-- bootstrap js -->
<script src="{{ asset('public/assets/frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/assets/frontend/js/plugins.js') }}"></script>
<!-- bootstrap selcet js -->
<script src="{{ asset('public/assets/frontend/js/bootstrap-select.js') }}"></script>
<!-- main js file -->
<script src="{{ asset('public/assets/frontend/js/custom.js') }}"></script>
</body>
</html>
