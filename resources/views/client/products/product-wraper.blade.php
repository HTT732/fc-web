<section id="productWrapper" class="product-wrapper mb-10 pb-8 appear-animate">
    <div class="container">
    	@include('client.menu.product-menu')

        @if(isset($successMess))
            <div class="text-left mb-3">
                Tìm thấy <strong>{{$products->count() ?? !empty($products)}}</strong> sản phẩm phù hợp
            </div>
        @endif

        @if(count($products) > 0)
            <div class="row grid products-grid mb-2" id="products-grid" data-grid-options="{
                'masonry': {
                    'columnWidth': ''
                }
            }">
            @foreach ($products as $product)
                <div class="col-md-3 col-sm-4 col-6 grid-item fillter{{$product->cate_id}}">
                    <div class="product text-center">
                        <figure class="product-media" style="background-color: #f9f9f9;">
                            <a href="{{route('product.show',['product'=>$product->id])}}">
                                <img src="{{asset($product->thumb_url)}}" alt="product" width="280"
                                    height="315">
                            </a>
                            <div class="product-action-vertical">
                                <a href="{{ route('main-page-order', ['id'=>$product->id]) }}" class="btn-product-icon" title="Thêm vào giỏ hàng"><i
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
                                <a href="shop-grid-3cols.html">{{$product->category->name ?? ''}}</a>
                            </div>
                            <h3 class="product-name">
                                <a href="{{route('product.show',['product'=>$product->id])}}">{{$product->name}}</a>
                            </h3>
                            <div class="product-price">
                                <span class="price">{{format_price($product->price)}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
            <div class="text-center">
                {{$products->onEachSide(1)->withQueryString()->links('pagination.pagination')}}
            </div>
        @else
            <div class="text-center">
                <strong>{{'Không có sản phẩm'}}</strong>
            </div>
        @endif
    </div>
</section>