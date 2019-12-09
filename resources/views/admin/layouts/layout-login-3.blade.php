<!DOCTYPE html>
<html>
<head>
    <title>BSWSC</title>
    <link href="{{ mix('/assets/admin/css/laraspace.css') }}" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.layouts.partials.favicons')
</head>
<body class="login-page login-3">

    <div id="app" class="site-wrapper">
        <div class="login-box">
            <div class="box-wrapper">
                @include('admin.layouts.partials.laraspace-notifs')
                <div class="logo-main">
                    <a href="/"><img src="/assets/admin/img/water-logo.jpg" alt="Laraspace Logo"></a>
                </div>
                @yield('content')
                <div class="page-copyright">
                    <p>Powered by <a href="http://bytefury.com" target="_blank">Geealee Soft</a></p>
                    <p>Bauchi State Water Board © {{ date('Y') }}</p>
                </div>
            </div>
        </div>
        <div class="content-box">
            <h1><b>Headstart</b> Manage your <br>
                System with ease.
            </h1>
        </div>
    </div>

<script src="{{mix('/assets/admin/js/core/plugins.js')}}"></script>
<script src="{{mix('/assets/admin/js/core/app.js')}}"></script>
@yield('scripts')
</body>
</html>
