<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>@yield('title')</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Riode - Ultimate eCommerce Template">
    <meta name="author" content="D-THEMES">
    <meta name="base_url" content="{{asset('client/')}}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{asset('client/media/icons/favicon.png')}}">

    <script>
        WebFontConfig = {
            google: { families: [ 'Jost:400,500,600,700,800,900' ] }
        };
        
    </script>

    <link rel="stylesheet" type="text/css" href="{{asset('client/vendor/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('client/vendor/animate/animate.min.css')}}">

    <!-- Plugins CSS File -->
    <link rel="stylesheet" type="text/css" href="{{asset('client/vendor/magnific-popup/magnific-popup.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('client/vendor/owl-carousel/owl.carousel.min.css')}}">

    @stack('css')

    <!-- Main CSS File -->
    <link rel="stylesheet" type="text/css" href="{{asset('client/css/app.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('client/css/my-style.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('client/css/style.css')}}"> --}}
    @stack('css')
</head>

<body class="home">
    <div class="page-wrapper">
        <h1 class="d-none">My web</h1>
        <header class="header">
            <div class="header-middle sticky-header fix-top sticky-content has-center">
                <div class="container">
                    @include('client.layouts.header.header-left')

                    {{-- @include('client.layouts.header.header-center') --}}

                    @include('client.layouts.header.header-right')
                </div>
            </div>
        </header>
        @yield('main')
    </div>
    <!-- End page-wrapper -->

    {{-- @include('client.sticky.sticky') --}}

    <footer class="footer">
	        <div class="container">
	            <div class="footer-middle text-center">
	                <div class="widget">
	                    <ul class="widget-body">
	                        <li><a href="{{route('home')}}">Trang chủ</a></li>
	                        @foreach ($data['categories'] as $category)
                                <li><a href="{{route('category', ['slug'=>$category->slug])}}">{{$category->name}}</a></li>
                            @endforeach
	                        <li><a href="#">Liên hệ</a></li>
	                    </ul>
	                </div>
	                <div class="social-links">
	                    <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
	                    <a href="#" class="social-link social-twitter fab fa-twitter"></a>
	                    <a href="#" class="social-link social-linkedin fab fa-linkedin-in"></a>
	                </div>
	            </div>
	            <!-- End of FooterMiddle -->
	            <div class="footer-bottom d-block text-center">
	                <p class="copyright"> &copy; 2021. All Rights Reserved</p>
	            </div>
	            <!-- End of FooterBottom -->
	        </div>
	    </footer>
    	<!-- End of Footer -->
    </div>
    <!-- page-wrapper -->

	 <!-- MobileMenu -->
    @include('client.menu.mobile-menu')
           
    <!-- Popup  -->
    @hasSection('popup')
        @yield('popup')
    @endif
    
    <!-- Right sidebar  -->
    @hasSection('sidebar')
        @yield('sidebar')
    @endif

     <!-- Scroll Top -->
    <a id="scroll-top" href="#top" title="Top" role="button" class="scroll-top"><i class="d-icon-arrow-up"></i></a>

    <!-- Plugins JS File -->
    <script src="{{asset('client/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('client/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

    <script src="{{asset('client/vendor/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('client/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('client/vendor/isotope/isotope.pkgd.min.js')}}"></script>

    @stack('script')

    <!-- Main JS File -->
    <script src="{{asset('client/js/main.js')}}"></script>
    <script src="{{asset('client/js/my-js.js')}}"></script>
</body>
</html>