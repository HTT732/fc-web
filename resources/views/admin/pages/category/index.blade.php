@extends('admin.templates.app')
@section('title', 'Danh mục sản phẩm')
@push('css')
    <!-- DataTables -->
    <link href="{{asset('admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />  
    <!-- Sweet Alerts js -->
    <script src="{{asset('admin/libs/sweetalert2/sweetalert.min.js')}}"></script>
@endpush
@section('main-content')
 <!-- start page title -->
 <div class="page-title-box" style="padding-top:24px">
    <div class="container-fluid">
     <div class="row align-items-center">
         <div class="col-sm-6">
             <div class="page-title" style="height:48px">
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
                            <li class="nav-item col-5 col-sm-3 col-md-4">
                                <a class="nav-link fw-bold p-3 active" href="#">Danh mục sản phẩm</a>
                            </li>
                             <div class="col-7 col-sm-9 col-md-8 float-end align-self-center">
                                <div class="float-end">
                                    <a href="{{route('admin.category.create')}}" class="btn btn-success"><i class="mdi mdi-plus me-2"></i> Thêm danh mục</a>
                                </div>
                             </div>
                        </ul>

                        <div class="table-responsive">
                            @if(count($categories) > 0)
                                <table id="dataTable" class="table table-centered datatable dt-responsive nowrap " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="d-table-cell d-xl-none">#</th>
                                            <th >Tên danh mục</th>
                                            <th class="text-center">Trạng thái</th>
                                            <th class="text-center">Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td class="details-control d-table-cell d-xl-none"></td>
                                            <td>{{$category->name}}</td>
                                            <td class="text-center">
                                                <div class="badge {{$category->active ? 'badge-soft-success' : 'badge-soft-warning'}} font-size-12">{{ $category->active ? 'Đang hiển thị' : 'Không hiển thị'}}</div>
                                            </td>
                                            <td id="tooltip-container1" class="text-center">
                                                <a href="{{route('admin.category.edit', ['category'=>$category->id])}}" class="text-primary" data-bs-container="#tooltip-container1" data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa">
                                                    <i class="mdi mdi-pencil font-size-18"></i>
                                                </a>
                                                <i class="mx-2"></i>
                                                <a href="{{route('admin.category.destroy', ['category'=>$category->id])}}" class="text-danger delete-btn category" data-bs-container="#tooltip-container1" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa">
                                                    <i class="mdi mdi-trash-can font-size-18"></i>
                                                </a>
                                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <tr colspan="4" class="text-center">Không có danh mục</tr>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    @if (session('success'))
        <script>
            swal("{{session('success')}}","", "success");
        </script>
    @endif
</div> <!-- container-fluid -->
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