@extends('admin.auth.templates.auth')
@section('title', 'Lỗi không tìm thấy')
@section('main-content')
    <div class="px-2 py-3">
        <div class="text-center">
            <a href="htt-index.html">
                <img src="{{asset('admin/images/logo-dark.png')}}" height="22" alt="logo">
            </a>

        </div>

        <div class="text-center p-3">
            <h1 class="error-page mt-5"><span>404!</span></h1>
            <h4 class="mb-4 mt-5">Xin lỗi, không tìm thấy trang!</h4>
            <a class="btn btn-primary waves-effect waves-light" href="{{route('admin.index')}}"><i class="mdi mdi-home"></i>Trở lại trang chủ</a>
        </div>
@endsection