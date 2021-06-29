@extends('admin.templates.app')
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
    <div class="page-title-box"  style="padding-top:45px">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h4>Hồ sơ cá nhân</h4>
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
                        <div class="card-body p-0 p-md-4">
                            <form action="{{route('admin.update', ['admin'=>$admin->id])}}" method="post" enctype="multipart/form-data" class="form-control border-0">
                                @csrf
                                @method('PUT')
                                <div class="mb-2">
                                    @if(count($errors) > 0)
                                        @foreach ($errors->all() as $err)
                                        <li class="text-danger">{{$err}}</li>
                                        @endforeach
                                        
                                    @endif
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-4 col-lg-3 col-form-label">Ảnh đại diện</label>
                                    <div class="col-sm-5 col-md-4 text-center">
                                        @if($admin->avatar)
                                            <img id="avatarImg" src="{{asset($admin->avatar)}}" alt="" class="rounded-circle avatar-lg">
                                        @else
                                            <img id="avatarImg" src="{{asset('admin/images/avatar/default.jpg')}}" alt="" class="rounded-circle avatar-lg">
                                        @endif
                                        <div class="col-5 mx-auto mt-3">
                                            <label for="avatar" class="col-12 btn btn-sm btn-outline-primary ">Thay đổi</label>
                                            <input type="file" name="avatar" class="btn" id="avatar" style="display: none;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="example-search-input" class="col-6 fw-bold col-sm-4 col-form-label col-lg-3 text-truncate">Quản trị viên</label>
                                    <div class="col-6 col-sm-5 col-md-4">
                                        <input type="text" name="name" class="form-control" value="{{$admin->name}}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="example-email-input" class="col-6 fw-bold col-sm-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-6 col-sm-5 col-md-4">
                                        <input type="text" name="email" class="form-control" value="{{$admin->email}}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="example-email-input" class="col-6 fw-bold col-sm-4 col-lg-3 col-form-label">Tài khoản</label>
                                    <div class="col-6 col-sm-5 col-md-4">
                                        <input type="text" name="username" class="form-control" value="{{$admin->username}}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="example-email-input" class="fw-bold col-6 col-sm-4 col-lg-3 col-form-label">Mật khẩu</label>
                                    <div class="col-6 col-sm-5 col-md-4">
                                        <label class="col-form-label">
                                            <a href="{{route('change-password')}}" class="col-form-label">Đổi mật khẩu</a>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="mt-2 btn btn-outline-primary waves-effect waves-light">Lưu thay đổi</button>
                                <a href="{{ url()->previous() }}" class="mt-2 btn btn-outline-danger waves-effect waves-light mx-2">Hủy</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div> <!-- container-fluid -->
     @if(session('successMessage'))
        <script>
            setTimeout(function () {
                swal({
                    title: '{{session('successMessage')}}',
                    icon: "success",
                });
            }, 2000);
        </script>
    @endif
@endsection