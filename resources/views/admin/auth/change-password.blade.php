@extends('admin.templates.app')
@push('css')
    <!-- DataTables -->
    <link href="{{asset('admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />  
@endpush

@section('main-content')
    <!-- start page title -->
    <div class="page-title-box"  style="padding-top:45px">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h4>Đổi mật khẩu</h4>
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
                        <div class="card-body">
                            <form action="{{route('admin.update', ['admin'=>Auth::id()])}}" method="post" class="form-control border-0">
                                @csrf
                                @method('put')
                                <div class="row mb-3">
                                    <label for="example-search-input" class="col-sm-4 col-form-label col-lg-3">Mật khẩu mới</label>
                                    <div class="col-sm-5 col-md-4">
                                        <input class="form-control" type="password" name="password" placeholder="Nhập mật khẩu mới" id="example-search-input">
                                        @error('password')
                                            <p class="my-2 text-danger fs-6">{{$message}}</p>
                                        @enderror
                                    </div>
                                    
                                </div>
                                <div class="row mb-3">
                                    <label for="example-email-input" class="col-sm-4 col-lg-3 col-form-label">Nhập lại mật khẩu mới</label>
                                    <div class="col-sm-5 col-md-4">
                                        <input class="form-control" type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu mới" id="example-email-input">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-primary waves-effect waves-light">Xác nhận</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div> <!-- container-fluid -->
@endsection