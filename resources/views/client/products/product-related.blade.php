<section>
	<h2 class="title title-center">SẢN PHẨM TƯƠNG TỰ</h2>
	<div class="owl-carousel owl-theme owl-nav-full row cols-2 cols-md-3 cols-lg-4"
		data-owl-options="{
				'items': 5,
				'nav': false,
				'loop': false,
				'dots': true,
				'margin': 20,
				'responsive': {
					'0': {
						'items': 2
					},
					'768': {
						'items': 3
					},
					'992': {
						'items': 4,
						'dots': false,
						'nav': true
					}
				}
			}">
		@if(isset($relatedProduct))
			@foreach ($relatedProduct as $product)
				@php
					$category = !empty($product->category) ? $product->category : false
				@endphp
				<div class="product text-center">
					<figure class="product-media" style="background-color: #F2F3F5;">
						<a href="{{route('product.show', ['product'=>$product->id])}}">
							<img src="{{asset($product->thumb_url)}}" alt="product" width="280" height="315">
						</a>
						<div class="product-action-vertical">
							<a href="{{route('main-page-order', ['id'=>$product->id])}}" class="btn-product-icon" title="Thêm vào giỏ hàng"><i
									class="d-icon-bag"></i></a>
							{{-- <a href="#" class="btn-product-icon btn-wishlist" title="Thêm vào xem sau"><i
									class="d-icon-heart"></i></a> --}}
						</div>
						<div class="product-action">
							<a href="{{route('product.show',['product'=>$product->id])}}" class="btn-product" title="Xem chi tiết">Xem chi tiết</a>
						</div>
					</figure>
					<div class="product-details">
						<div class="product-cat">
							<a href="{{route('category', ['slug', $category->name ?? $category])}}">{{$category->name ?? $category}}</a>
						</div>
						<h3 class="product-name">
							<a href="{{route('product.show', ['product'=>$product->id])}}">{{$product->name}}</a>
						</h3>
						<div class="product-price">
							<ins class="new-price">{{format_price($product->price)}}</ins>
						</div>
					</div>
				</div>
			@endforeach
		@endif
	</div>
</section>