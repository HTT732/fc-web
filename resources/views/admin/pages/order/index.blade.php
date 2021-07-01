@extends('admin.templates.app')
@section('title', 'Danh sách đơn hàng')
@push('css')
        <!-- DataTables -->
        <link href="{{asset('admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{asset('admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />  

        <script src="{{asset('admin/libs/sweetalert2/sweetalert.min.js')}}"></script>
@endpush
@section('main-content')
    <div class="page-content" style="padding: calc(13px) calc(24px / 2) 60px calc(24px / 2)!important">

        <!-- start page title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="page-title">
                            <h4>Đơn đặt hàng</h4>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- end page title -->
        <div class="container-fluid">
            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-lg-12 p-0">
                        <div class="card">
                            <div class="card-body  pt-0">
                                <ul class="nav nav-tabs nav-tabs-custom mb-4">
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold p-3 active" href="#">Đơn hàng</a>
                                    </li>
                                </ul>
                                <div class="table-responsive">
                                @if(count($orders) > 0)
                                    <table id="dataTable" class="table table-centered datatable dt-responsive nowrap " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="thead-light">
                                            <tr>
                                                <th style="width: 20px;" class="d-table-cell d-xl-none">
                                                    #
                                                </th>
                                                <th>Mã đơn</th>
                                                <th>Ngày đặt</th>
                                                <th>Khách hàng</th>
                                                <th>Tổng đơn</th>
                                                <th>Trạng thái</th>
                                                <th>Chi tiết</th>
                                                <th style="width: 60px">Xóa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td class="details-control d-table-cell d-xl-none">
                                                    </td>
                                                    <td><a href="javascript: void(0);" class="text-dark fw-bold">{{order_code($order->order_number)}}</a> </td>
                                                    <td>
                                                        {{$order->date}}
                                                    </td>
                                                    <td>{{$order->customer_name ?? ''}}</td>
                                                    <td>
                                                        {{format_price($order->total)}}
                                                    </td>
                                                    <td class="td-process">
                                                    @if($order->active == '2')
                                                        <div class="badge badge-soft-success font-size-12">Đã xử lý</div>
                                                    @else
                                                        <div data-url="{{route('admin.order.update', ['order' => $order->order_token])}}" class="process-order btn btn-warning">Chưa xử lý</div>
                                                    @endif
                                                    </td>
                                                    <td id="tooltip-container1">
                                                        <a href="{{route('admin.order.show', ['order' => $order->order_token])}}" class="btn btn-sm me-3 text-primary fw-bold" data-bs-container="#tooltip-container1" data-bs-toggle="tooltip" data-bs-placement="top" title="Chi tiết">Xem</a>
                                                    </td>
                                                    <td id="tooltip-container1" class="text-center">
                                                        <a href="{{route('admin.order.destroy', ['order' => $order->order_token])}}" class="delete-btn text-danger" data-bs-container="#tooltip-container1" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa"><i class="mdi mdi-trash-can font-size-18"></i></a>
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        
                                        </tbody>
                                    </table>
                                @else
                                    <tr colspan="7" class="text-center">
                                        <p>Chưa có đơn đặt hàng.</p>
                                    </tr>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
@push('script')
    <!-- Required datatable js -->
    <script src="{{asset('admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    
    <!-- Responsive examples -->
    <script src="{{asset('admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/js/pages/ecommerce-datatables.init.js')}}"></script>
@endpush
