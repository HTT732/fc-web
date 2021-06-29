@extends('client.template.app')
@section('title', 'Checkout')
@section('main')
    <main class="main checkout">
        <div class="page-content pt-7 pb-10 mb-10">
            <div class="step-by pr-4 pl-4">
                @include('client.cart.step-checkout')
            </div>
            <div class="container mt-7">
                @if(session('error_checkout'))
                    <p class="text-danger">{{session('error_checkout')}}</p>
                @endif
                <form action="{{route('postCheckout')}}" class="form" method="post">
                    @csrf
                    <input type="hidden" name="order_token" value="{{$data['product_orders'][0]->order_token ?? ''}}"/>
                    <div class="row">
                        <div class="col-lg-7 mb-6 mb-lg-0 pr-lg-4">
                            <h3 class="title title-simple text-left text-uppercase">Thông Tin Khách Hàng</h3>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label>Họ Tên (*)</label>
                                    <input type="text" class="form-control mb-1" name="customer_name" value="{{old('username')}}" required />
                                    @error('customer_name')
                                        <p class="text-danger mb-0">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-xs-6">
                                    <label>Số Điện Thoại (*)</label>
                                    <input type="text" class="form-control mb-1" name="customer_phone" value="{{old('phone')}}" required/>
                                    @error('customer_phone')
                                        <p class="text-danger mb-0">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <label class="mt-3">Địa chỉ (*)</label>
                            <input type="text" class="form-control mb-1" name="customer_address" required=""
                                placeholder="Số nhà, Tên đường, Phường, Quận/Huyện, Tỉnh/TP"  value="{{old('address')}}"/>
                            @error('customer_address')
                                <p class="text-danger mb-0">{{$message}}</p>
                            @enderror
                            <h2 class="title title-simple text-uppercase text-left pt-3 mb-3">Thông Tin Thêm</h2>
                            <label>Ghi chú cho đơn hàng</label>
                            <textarea name="customer_note" class="note form-control pb-2 pt-2 mb-0" cols="30" rows="5"
                                placeholder="Nhập để viết ghi chú cho đơn hàng"></textarea>
                        </div>
                        <aside class="col-lg-5 sticky-sidebar-wrapper">
                            <div class="sticky-sidebar mt-1" data-sticky-options="{'bottom': 50}">
                                <div class="summary pt-5">
                                    <h3 class="title title-simple text-left text-uppercase">ĐƠN HÀNG</h3>
                                    <table class="order-table">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($data['product_orders']) && count($data['product_orders']) > 0)
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($data['product_orders'] as $detail)
                                                @php
                                                    $subTotal = $detail->product->price * $detail->order->quanlity;
                                                    $total += $subTotal;
                                                @endphp
                                                <tr>
                                                    <td class="product-name">{{$detail->product->name}}<span
                                                            class="product-quantity">×&nbsp;{{$detail->order->quanlity}}</span></td>
                                                    <td class="product-total text-body">{{format_price($subTotal)}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                            <tr class="summary-total">
                                                <td class="pb-0">
                                                    <h4 class="summary-subtitle">Tổng</h4>
                                                </td>
                                                <td class=" pt-0 pb-0">
                                                    <p class="summary-total-price ls-s text-primary">{{format_price($total)}}</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-dark btn-rounded btn-order">Đặt Hàng</button>
                                </div>
                            </div>
                        </aside>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection