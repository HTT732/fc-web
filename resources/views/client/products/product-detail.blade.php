@extends('client.template.app')
@section('title', 'Chi tiết sản phẩm')
@push('css')
	<link rel="stylesheet" type="text/css" href="{{asset('client/vendor/photoswipe/photoswipe.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('client/vendor/photoswipe/default-skin/default-skin.min.css')}}">
@endpush
@section('main')
	<main class="main mt-6 single-product">
		<div class="page-content mb-10 pb-6">
			<div class="container">
				@include('client.products.product-single')

				@include('client.products.product-tab')

				@include('client.products.product-related')
			</div>
		</div>
	</main>
@endsection
@push('script')
	<script src="{{asset('client/vendor/elevatezoom/jquery.elevatezoom.min.js')}}"></script>
	<script src="{{asset('client/vendor/photoswipe/photoswipe.min.js')}}"></script>
	<script src="{{asset('client/vendor/photoswipe/photoswipe-ui-default.min.js')}}"></script>
@endpush
