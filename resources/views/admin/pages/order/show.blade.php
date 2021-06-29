@extends('admin.templates.app')
@section('title', 'Chi tiết đơn hàng')
@section('main-content')
    <!-- start page title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h4>Chi tiết đơn hàng</h4>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- end page title -->    

    <div class="container-fluid">
        <div class="page-content-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                        @if(!empty($details))
                            <div class="row">
                                <div class="col-12">
                                    <div class="invoice-title">
                                        <h4 class=" font-size-16"><strong>Đơn hàng {{order_code($details[0]->order_number)}}</strong></h4>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <address>
                                                <strong>Địa chỉ:</strong>
                                                <span>{{$details[0]->order->customer_address ?? ''}}</span>
                                            </address>
                                            <address>
                                                <strong>Số điện thoại:</strong>
                                                <span>{{$details[0]->order->customer_phone ?? ''}}</span>
                                            </address>
                                            <address>
                                                <strong>Ngày đặt hàng:</strong>
                                                <span>{{$details[0]->updated_at ?? ''}}</span>
                                            </address>
                                            <address>
                                                <strong>Ghi chú:</strong>
                                                <span>
                                                    {{$details[0]->order->customer_note ?? ''}}
                                                </span>
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="panel panel-default">
                                        <div class="p-2">
                                            <h3 class="panel-title font-size-20"><strong>Chi tiết</strong></h3>
                                        </div>
                                        <div class="">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <td><strong>Sản phẩm</strong></td>
                                                        <td class="text-center"><strong>Giá</strong></td>
                                                        <td class="text-center"><strong>Số lượng</strong>
                                                        </td>
                                                        <td class="text-end"><strong>Số tiền</strong></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        $total = 0;
                                                    @endphp
                                                    @foreach ($details as $detail)
                                                        @php
                                                            $total += $detail->order->quanlity * $detail->product->price;
                                                            $subTotal = $detail->order->quanlity * $detail->product->price
                                                        @endphp
                                                    <tr>
                                                        <td>{{$detail->product->name ?? ''}}</td>
                                                        <td class="text-center">{{format_price($detail->product->price) ?? 0}}</td>
                                                        <td class="text-center">{{$detail->order->quanlity ?? 'NaN'}}</td>
                                                        <td class="text-end">{{format_price($subTotal)}}</td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line text-center">
                                                            <strong>Tổng tiền</strong></td>
                                                        <td class="no-line text-end"><h4 class="m-0">{{format_price($total)}}</h4></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="d-print-none mo-mt-2">
                                                <div class="float-end">
                                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                    <a href="{{route('admin.order.index')}}" class="btn btn-primary waves-effect waves-light">Quay lại</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> <!-- end row -->
                        @else
                            <p class="text-danger">Không tìm thấy đơn hàng</p>
                        @endif
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row --> 

        </div>

        
    </div> <!-- container-fluid -->
@endsection
