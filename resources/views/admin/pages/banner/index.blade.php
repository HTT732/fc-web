@extends('admin.templates.app')
@section('title', 'Banner')
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
    <div class="page-title-box"  style="padding-top:24px">
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
                                <li class="nav-item">
                                    <a class="nav-link fw-bold p-3 active" href="#">Quản lý banner</a>
                                </li>
                            </ul>

                            @php
                                if(!count($sliders)){
                                    $sliders = [];
                                }
                            @endphp

                            <div class="table-responsive">
                                @if(!count($sliders))
                                    <p class="text-center"><strong>Không có banner</strong></p>
                                @endif
                                <div class="input-group m-0 mb-4 row">
                                    <form action="{{route('admin.banner.store')}}" class="form" enctype="multipart/form-data" method="post">
                                        @csrf
                                        <label class="btn btn-outline-primary col-7 col-md-3 mb-0" for="uploadBanner" >Chọn ảnh banner</label> 
                                        <input type="file" id="uploadBanner" name="files[]" multiple class="col-5 col-md-3 btn btn-primary" id="customFile" style="display:none">
                                        <button class="btn-update btn btn-primary">Tải lên</button>
                                        <p class="mt-2 text-primary"></p>
                                        @if(isset($errors) && count($errors) > 0)
                                        <ul class="text-danger">
                                            @foreach ($errors->all() as $err)
                                                <li>{{$err}}</li>        
                                            @endforeach
                                        </ul>
                                        @endif
                                        <div class="loading hide">
                                            <div class="spinner-grow text-primary m-1" role="status">
                                            </div>
                                            <div class="spinner-grow text-secondary m-1" role="status">
                                            </div>
                                            <div class="spinner-grow text-success m-1" role="status">
                                            </div>
                                            <div class="spinner-grow text-info m-1" role="status">
                                            </div>
                                            <div class="spinner-grow text-warning m-1" role="status">
                                            </div>
                                            <div class="spinner-grow text-danger m-1" role="status">
                                            </div>
                                            <div class="spinner-grow text-dark m-1" role="status">
                                            </div>
                                            </div>
                                    </form>
                                </div>
                                <div class="row col-md-8 col-lg-6"> 
                                    <table id="dataTable" class="table table-centered datatable dt-responsive nowrap " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Banner</th>
                                                <th class="text-center">Xóa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sliders as $index => $slider)
                                                <tr>
                                                    <td>
                                                        <img class="img-thumbnail" src="{{asset($slider->small_url)}}" style="width: 380px">
                                                    </td>
                                                    <td id="tooltip-container1" class="text-center">
                                                        <a href="{{route('admin.banner.destroy', ['banner'=>$slider->id])}}" data-id="{{$slider->id}}" class="delete-btn text-danger" data-bs-container="#tooltip-container1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                            <i class="mdi mdi-trash-can font-size-18"></i>
                                                            
                                                        </a>
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div>
        @if(session('success'))
            <script>
                swal("{{session('success')}}","", "success");
            </script>
        @endif

        @if(session('failed'))
            <script>
                swal("{{session('failed')}}","", "warning");
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
@endpush
