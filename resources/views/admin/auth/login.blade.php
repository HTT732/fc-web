@extends('admin.auth.templates.auth')
@section('title', 'Đăng nhập')
@section('main-content')
    <div class="px-2 py-3">
        <div class="text-center">
            <h5 class="text-primary mb-2 mt-4">Đăng nhập</h5>
            @if(count($errors))
                @foreach ($errors->all() as $err)
                    <li class="text-danger">{{$err}}</li>
                @endforeach
            @elseif(session('error'))
                <p class="text-danger">{{session('error') ?? 'Đã xảy ra lỗi!'}}</p>
            @elseif(session('success'))
                <p class="text-success">{{session('success')}}</p>
            @endif
        </div>

        <form class="form-horizontal mt-4 pt-2" action="{{route('login.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="username">Tài khoản</label>
                <input type="text" class="form-control" id="username" name="username"
                    placeholder="Nhập email hoặc tài khoản">
            </div>
            <div class="mb-3">
                <label for="userpassword">Mật khẩu</label>
                <input type="password" name="password" class="form-control" id="userpassword"
                    placeholder="Nhập mật khẩu">
            </div>
            <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="remmeber_token" class="form-check-input"
                            id="customControlInline">
                        <label class="form-label"
                            for="customControlInline">Ghi nhớ đăng nhập</label>
                    </div>
            </div>
            <div>
                <button class="btn btn-primary w-100 waves-effect waves-light"
                    type="submit">Đăng nhập</button>
            </div>
            {{-- <div class="mt-4 text-center">
                <a href="{{route('forgot-password')}}" class="text-muted"><i class="mdi mdi-lock me-1"></i> Quên mật khẩu?</a>
            </div> --}}
        </form>
    </div>
@endsection