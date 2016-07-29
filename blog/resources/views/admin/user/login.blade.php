@extends('layouts.login')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <b>{{ config('website_title') }}</b>
        </div>

        <div class="login-box-body">

            @if(is_object($errors) && count($errors) > 0)
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p>{{ $errors->first() }}</p>
                </div>
            @endif

            @if(is_string($errors))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p>{{ $errors }}</p>
                </div>
            @endif

            <form action="#" method="post">
                {{ csrf_field() }}
                <div class="form-group has-feedback">

                    <input type="text" class="form-control" placeholder="username" name="username" value="{{ Session::get('username', '') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="password" name="password" value="{{ Session::get('password', '') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <a href="{{ url('admin/register') }}" class="btn btn-info btn-block btn-flat">register</a>
                    </div>
                    <div class="col-xs-6">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">login</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection