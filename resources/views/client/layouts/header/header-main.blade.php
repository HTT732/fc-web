<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Web</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Riode - Ultimate eCommerce Template">
    <meta name="author" content="D-THEMES">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{asset('client/media/icons/favicon.png')}}">

    <script>
        WebFontConfig = {
            google: { families: [ 'Jost:400,500,600,700,800,900' ] }
        };
        ( function ( d ) {
            var wf = d.createElement( 'script' ), s = d.scripts[ 0 ];
            wf.src = 'http://localhost/fc-web-electricity-water/public/client/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore( wf, s );
        } )( document );
    </script>

    <link rel="stylesheet" type="text/css" href="{{asset('client/vendor/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('client/vendor/animate/animate.min.css')}}">

    <!-- Plugins CSS File -->
    <link rel="stylesheet" type="text/css" href="{{asset('client/vendor/magnific-popup/magnific-popup.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('client/vendor/owl-carousel/owl.carousel.min.css')}}">

    <!-- Main CSS File -->
    <link rel="stylesheet" type="text/css" href="{{asset('client/css/app.min.css')}}">
</head>

<body class="home">
    <div class="page-wrapper">
        <h1 class="d-none">My web</h1>
        <header class="header">
            <div class="header-middle sticky-header fix-top sticky-content has-center">
                <div class="container">
                    @include('client.layouts.header.header-left')

                    @include('client.layouts.header.header-center')

                    @include('client.layouts.header.header-right')
                </div>

            </div>
        </header>