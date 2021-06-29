    <div class="dropdown-box">
        <div class="cart-header">
            <h4 class="cart-title">Giỏ hàng</h4>
            <a href="#" class="btn btn-dark btn-link btn-icon-right btn-close">Đóng<i
                    class="d-icon-arrow-right"></i><span class="sr-only">Giỏ hàng</span></a>
        </div>
        @if(count($data['product_orders']) > 0)
        <div class="products scrollable">
            @php
                $total = 0;
            @endphp
            @foreach ($data['product_orders'] as $detail)
                @php $total += $detail->product->price * $detail->order->quanlity @endphp
                <div class="product product-cart">
                    <figure class="product-media">
                        <a href="{{ route('product.show', ['product'=>$detail->product->id]) }}">
                            <img src="{{asset($detail->product->thumb_url)}}" alt="{{ $detail->product->name }}" width="80"
                                height="88" />
                        </a>
                        <button class="btn btn-link btn-close" data-url="{{route('delete', ['token'=>$detail->order_token, 'id'=>$detail->product->id])}}">
                            <i class="fas fa-times"></i>
                            <span class="sr-only">Close</span>
                        </button>
                    </figure>
                    <div class="product-detail">
                        <a href="{{ route('product.show', ['product'=>$detail->product->id]) }}" class="product-name">{{ $detail->product->name }}</a>
                        <div class="price-box">
                            <span class="product-quantity">{{$detail->order->quanlity}}</span>
                            <span class="product-price">{{ format_price($detail->product->price) }}</span>
                        </div>
                    </div>
                </div>
                <!-- End of Cart Product -->
            @endforeach
        </div>
        <!-- End of Products  -->
        <div class="cart-total">
            <label>Tổng:</label>
            <span class="price">{{ format_price($total) }}</span>
        </div>
        <!-- End of Cart Total -->
        <div class="cart-action">
            <a href="{{ route('shopping-cart') }}" class="btn btn-dark btn-link mb-4">Xem giỏ hàng</a>
            <a href="{{ route('checkout') }}" class="btn btn-dark"><span>Thanh toán</span></a>
        </div>
        <!-- End of Cart Action -->
        @else
            <p class="text-center mt-3">Chưa có sản phẩm</p>
        @endif
    </div>