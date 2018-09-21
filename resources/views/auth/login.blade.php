<!-- login.blade.php -->

@extends('layouts.app')

@section('content')
    <body>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        @csrf                     <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                       required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                        <br/>
                        <p style="margin-left:265px">OR</p>
                        <br/>
                        <div class="row" style="margin-left:10%;">

                            <div class="col-md-1 ">
                                <fb:login-button class="btn btn-info" style="height:40px"
                                                 scope="public_profile,email"
                                                 onlogin="checkLoginState();">
                                </fb:login-button>

                            </div>
                            <div class="col-sm-1">

                                <div class="pull-right" style="height:40px;">
                                    <a class="btn btn-danger" href="{{ route('glogin') }}"> Login with Google</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
    </body>
@endsection
<script>

    window.fbAsyncInit = function () {
        FB.init({
            appId: '337192723491074',
            cookie: true,
            xfbml: true,
            version: 'v2.8'
        });

        FB.AppEvents.logPageView();

    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    function getUserData() {
        FB.api('/me', {fields: 'id,first_name,email'}, function (response) {
            $.ajax({
                url: "/facebooklogin",
                data: response,
                success: function (rsp) {
                    window.location = rsp;
                }
            });
        });
    }

    function checkLoginState() {
        FB.getLoginStatus(function (response) {
            if (response.authResponse) {
                getUserData();
            } else {
                alert("Hatalı Giriş");
            }
        });
    }

</script>