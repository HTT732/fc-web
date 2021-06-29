@extends('admin.auth.templates.auth')
@section('title', 'title')
@section('content', 'dfdf')
@section('main-content')
    <div class="card-body">
        <div class="px-2 py-3">
            <div class="text-center">
                <a href="index.html">
                    <img src="{{asset('admin/images/logo-dark.png')}}" height="22" alt="logo">
                </a>

                <h5 class="text-primary mb-2 mt-4">Lấy lại mật khẩu</h5>
            </div>

            <div class="alert alert-success text-center mb-4 mt-4 pt-2" role="alert">
                Nhập địa chỉ email để đặt lại mật khẩu!
            </div>


            <form class="form-horizontal" method="post" action="{{route('reset-password')}}">
                @csrf
                <div class="mb-3">
                    <label for="useremail">Email</label>
                    <input type="email" name="email" class="form-control" id="useremail" placeholder="Nhập email">
                    @error('email')
                        <p class="text-danger mb-0 mt-2">{{$message}}<p>
                    @enderror
                </div>

                <div class="row mb-0">
                    <div class="col-12 text-end">
                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Xác nhận</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection