@extends('client.template.app')
@section('title', 'Giỏ Hàng')
@section('main')
    <main class="main cart">
        <div class="page-content pt-7 pb-10">
            <div class="step-by pr-4 pl-4">
                @include('client.cart.step-checkout')
            </div>
            <div class="container mt-7 mb-2">
                <div class="row">
                    <div class="col-lg-8 col-md-12 pr-lg-4">
                        <table class="shop-table cart-table" data-token="{{csrf_token()}}">
                            <thead>
                                <tr>
                                    <th><span>Sản phẩm</span></th>
                                    <th></th>
                                    <th><span>Giá</span></th>
                                    <th><span>Số lượng</span></th>
                                    <th>Số tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if (isset($data['product_orders']) && count($data['product_orders']) > 0)
                                @php  $total = 0; @endphp
                                @foreach ($data['product_orders'] as $key => $detail)
                                    @php
                                        $subTotal = 0;
                                        $subTotal += $detail->product->price * $detail->order->quanlity;
                                        $total += $subTotal;
                                    @endphp
                                    <tr data-order_id="{{$detail->order_id}}">
                                        <td class="product-thumbnail">
                                            <figure>
                                                <a href="{{route('product.show', ['product'=>$detail->product->id])}}">
                                                    <img src="{{asset($detail->product->thumb_url)}}" width="100" height="100"
                                                        alt="product">
                                                </a>
                                            </figure>
                                        </td>
                                        <td class="product-name">
                                            <div class="product-name-section">
                                                <a href="{{route('product.show', ['product'=>$detail->product->id])}}">
                                                    {{$detail->product->name}}
                                                </a>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount">{{format_price($detail->product->price)}}</span>
                                        </td>
                                        <td class="product-quantity">
                                            <div class="input-group">
                                                <button class="quantity-minus d-icon-minus" data-quantity="{{$detail->order->quanlity}}"></button>
                                                    <input class="input-quantity form-control" min="1"
                                                    max="1000000" type="number" value="{{$detail->order->quanlity}}">
                                                <button class="quantity-plus d-icon-plus" data-quantity="{{$detail->order->quanlity}}"></button>
                                            </div>
                                        </td>
                                        <td class="product-price">
                                            <span class="amount">{{format_price($subTotal)}}</span>
                                        </td>
                                        <td class="product-close">
                                            <a href="{{route('delete', ['token'=>$detail->order_token, 'id'=>$detail->product->id])}}" class="product-remove" title="Xóa sản phẩm">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            @else
                                <tr class="text-center"><td colspan="5"><strong>Không có sản phẩm</strong></td></tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="cart-actions mb-6 pt-4">
                            <a href="{{url()->previous()}}" class="btn btn-dark btn-md btn-rounded btn-icon-left mr-4 mb-4"><i class="d-icon-arrow-left"></i>TIẾP TỤC MUA SẮM</a>
                            <button type="submit" data-url="{{route('update')}}" class="btn-cart-update btn btn-outline btn-dark btn-md btn-rounded btn-disabled">CẬP NHẬT GIỎ HÀNG</button>
                        </div>
                    </div>
                    <aside class="col-lg-4 sticky-sidebar-wrapper">
                        <div class="sticky-sidebar" data-sticky-options="{'bottom': 20}">
                            <div class="summary mb-4">
                                <h3 class="summary-title text-left">GIỎ HÀNG</h3>
                                <table class="total">
                                    <tr class="summary-subtotal">
                                        <td>
                                            <h4 class="summary-subtitle">Tổng tiền</h4>
                                        </td>
                                        <td>
                                            <p class="summary-total-price ls-s">{{isset($total) ? format_price($total) : 0}}</p>
                                        </td>												
                                    </tr>
                                </table>
                                <a href="{{route('checkout')}}" class="btn btn-dark btn-rounded btn-checkout">Thanh Toán</a>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </main>
@endsection