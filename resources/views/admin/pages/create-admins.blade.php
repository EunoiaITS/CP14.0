@extends('admin.layout')
@section('title','Create Admin')
@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Create User</h1>
            </div>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                @include('admin.includes.messages')
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger">
                            {{ $error }}
                        </p>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="post" action="{{ url('/admin/create-admin') }}" role="form">
                            <fieldset>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter User Name" name="name" type="text" autofocus="" required="" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter Your Email" name="email" type="email" autofocus="" required="" value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="{{ old('password') }}" required="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Re-type Password" name="repass" type="password" value="{{ old('repass') }}" required="">
                                </div>
                                <button class="btn btn-info btn-offer" type="submit">Create</button>
                            </fieldset>
                            <input type="hidden" name="role" value="super-admin">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <p class="back-link">© 2018. All rights reserved</p>
        </div>
    </div>	<!--/.main-->

    @endsection