<div class="product product-single row mb-8">
	<div class="col-md-6">
		<div class="product-gallery">
			<div class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1">
			@if(isset($pictures) && count($pictures) > 0)
				@foreach ($pictures as $picture)
					<figure class="product-image" style="background-color: #F2F2F2;">
						<img src="{{asset($picture->medium)}}"
						data-zoom-image="{{asset($picture->large)}}"
						alt="{{$picture->name}}" width="800" height="900">
					</figure>
				@endforeach
			@endif
			</div>
			<div class="product-thumbs-wrap">
				<div class="product-thumbs">
					@if(isset($pictures) && count($pictures) > 0)
						@foreach ($pictures as $picture)
							<div class="product-thumb {{'active' ?? $loop->first}}" style="background-color: #F2F2F2;">
								<img src="{{asset($picture->small)}}"
								alt="{{$picture->name}}" width="109" height="122">
							</div>
						@endforeach
					@endif
				</div>
				<button class="thumb-up disabled"><i class="fas fa-chevron-left"></i></button>
				<button class="thumb-down disabled"><i class="fas fa-chevron-right"></i></button>
			</div>
		</div>
	</div>
	<div class="col-md-6 sticky-sidebar-wrapper">
		<div class="product-details sticky-sidebar">
			<div class="product-navigation">
				<ul class="breadcrumb breadcrumb-lg">
					<li><a href="{{route('home')}}"><i class="d-icon-home"></i></a></li>
					<li><a href="{{route('category', ['slug'=>$product->slug])}}" class="active">{{$product->category->name}}</a></li>
					<li>{{$product->name}}</li>
				</ul>
			</div>
			<h1 class="product-name">{{$product->name}}</h1>
			<div class="product-meta">
				@if(isset($specification->brand))
					NHÃN HIỆU: <span class="product-brand">The Northland</span>
				@endif
			</div>
			
			<div class="product-price">{{format_price($product->price)}}</div>
			<p class="product-short-desc">{{$product->short_description}}</p>

			<hr class="product-divider">

			<div class="product-form product-qty">
				<div class="product-form-group">
					<div class="input-group mr-2">
						<button class="single-quantity-minus d-icon-minus"></button>
						<input class="input-quantity form-control" min="1"
							max="1000000" type="number" value="1">
						<button class="single-quantity-plus d-icon-plus"></button>
					</div>
					<a data-url="{{route('main-page-order',['id'=>$product->id])}}"
						href="{{route('main-page-order',['id'=>$product->id])}}" class="btn-product btn-cart-custom text-normal ls-normal font-weight-semi-bold"><i
							class="d-icon-bag"></i>Thêm vào giỏ hàng
					</a>
				</div>
			</div>

			<hr class="product-divider mb-3">
		</div>
	</div>
</div>