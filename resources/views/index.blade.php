@extends('client.template.app')
@section('title', 'Web')
@section('main')
<main class="main">
    <div class="page-content">
    	<!-- Slider -->
    	@include('client.slide.slide')

    	<!-- List product -->
        @include('client.products.product-wraper')
    </div>
</main>
<!-- End of Main -->
@endsection

@section('sidebar')
	@include('client.sidebar.right-sidebar')
@endsection



