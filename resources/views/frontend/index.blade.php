<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ appName() }}</title>
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
    @yield('meta')

    @stack('before-styles')
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">

    <meta name="google-signin-client_id"
        content="585199978695-fvmn90848gr7mm2vdkqd1l5uqaquc2fk.apps.googleusercontent.com">

    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

    </style>
    @stack('after-styles')
</head>

<body>
    <div id="my-signin2"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId: '180768544140691',
                cookie: true,
                xfbml: true,
                version: 'v7.0'
            });

            FB.AppEvents.logPageView();

        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        // FB.getLoginStatus(function(response) {
        //     statusChangeCallback(response);
        // });

        function checkLoginState() {
            FB.getLoginStatus(function(response) {
                console.log('response:', response)
                // statusChangeCallback(response);
            });
        }
    </script>
    <script>
        function onSuccess(googleUser) {
            console.log(googleUser.getAuthResponse(true));
        }

        function onFailure(error) {
            console.log("ERROR", error);
        }

        function renderButton() {
            gapi.signin2.render('my-signin2', {
                'scope': 'profile email',
                'width': 240,
                'height': 50,
                'longtitle': true,
                'theme': 'dark',
                'onsuccess': onSuccess,
                'onfailure': onFailure
            });
        }
    </script>
    <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
    @include('includes.partials.read-only')
    @include('includes.partials.logged-in-as')

    <div id="app" class="flex-center position-ref full-height">
        <div class="top-right links">
            @auth
                @if ($logged_in_user->isUser())
                    <a href="{{ route('frontend.user.dashboard') }}">@lang('Dashboard')</a>
                @endif

                <a href="{{ route('frontend.user.account') }}">@lang('Account')</a>
            @else
                <a href="{{ route('frontend.auth.login') }}">@lang('Login')</a>

                @if (config('boilerplate.access.user.registration'))
                    <a href="{{ route('frontend.auth.register') }}">@lang('Register')</a>
                @endif
            @endauth
        </div>
        <!--top-right-->

        <div class="content">
            @include('includes.partials.messages')

            <div class="title m-b-md">
                <example-component></example-component>
            </div>
            <!--title-->
            <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
            </fb:login-button>

            <div class="links">
                <a href="http://laravel-boilerplate.com" target="_blank"><i class="fa fa-book"></i>
                    @lang('Docs')</a>
                <a href="https://github.com/rappasoft/laravel-boilerplate" target="_blank"><i class="fab fa-github"></i>
                    GitHub</a>
            </div>
            <!--links-->
        </div>
        <!--content-->
    </div>
    <!--app-->

    @stack('before-scripts')
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/frontend.js') }}"></script>
    @stack('after-scripts')
</body>

</html>
