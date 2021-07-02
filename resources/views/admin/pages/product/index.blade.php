@extends('admin.templates.app')
@section('title', 'Product')
@push('css')
    <!-- DataTables -->
    <link href="{{asset('admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />  
    <script src="{{asset('admin/libs/sweetalert2/sweetalert.min.js')}}"></script>
@endpush
@section('main-content')
<div class="page-title-box" style="padding:32px 24px 113px 24px">
    <div class="container-fluid">
     <div class="row align-items-center">
         <div class="col-6">
             <div class="page-title">
                 <h4>Quản lý sản phẩm</h4>
             </div>
         </div>
         <div class="col-6">
            <div class="float-end">
                <a href="{{route('admin.product.create')}}" class="btn btn-success">
                 <i class="mdi mdi-plus"></i>
                 Thêm sản phẩm
                 </a>
            </div>
         </div>
     </div>
    </div>
 </div>
 <!-- end page title -->    


<div class="container-fluid">

    <div class="page-content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body  pt-0">
                        <ul class="nav nav-tabs nav-tabs-custom mb-4">
                            <li class="nav-item">
                                <a class="nav-link fw-bold p-3 active" href="#">Tất cả sản phẩm</a>
                            </li>
                        </ul>
                        <div class="table-responsive">
                        @if(count($products) > 0)
                            <table id="dataTable" class="table table-centered table-hover datatable dt-responsive nowrap " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="d-table-cell d-xl-none"></th>
                                        <th>Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Danh mục</th>
                                        <th>Giá tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Sửa/Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $product)
                                     <tr>
                                        <td class="details-control d-table-cell d-xl-none">
                                        </td>
                                        <td>
                                        <a href="{{route('product.show',['product'=>$product->id])}}">
                                            <img href="{{route('product.show',['product'=>$product->id])}}" class="avatar-xl" src="{{asset($product->thumb_url)}}"></a>
                                        </a>
                                        </td>
                                        <td>
                                            <a href="{{route('product.show',['product'=>$product->id])}}" class="text-dark ">{{$product->name}}</a> 
                                        </td>
                                        <td>{{$product->category->name ?? '' }}</td>
                                        <td>
                                            {{format_price($product->price)}}
                                        </td>
                                        <td>
                                            <div class="badge {{$product->active ? 'badge-soft-success' : 'badge-soft-warning'}} font-size-12">{{ $product->active ? 'Đã đăng bán' : 'Chưa đăng bán'}}</div>
                                        </td>
                                        <td id="tooltip-container1">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <a href="{{route('admin.product.edit', ['product'=>$product->id])}}" class="me-3 text-primary" data-bs-container="#tooltip-container1" data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa"><i class="mdi mdi-pencil font-size-18"></i></a>
                                            <a href="{{route('admin.product.destroy', ['product'=>$product->id])}}" class="product delete-btn text-danger" data-id="{{$product->id}}" data-bs-container="#tooltip-container1" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa"><i class="mdi mdi-trash-can font-size-18"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                   
                                </tbody>
                            </table>
                            @else
                                <p class="text-center">Không có sản phẩm</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
</div> <!-- container-fluid -->
@if(session('successMessage'))
    <script>
        swal({
            title: "{{session('successMessage')}}",
            icon: "success",
        });
    </script>
@endif
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
