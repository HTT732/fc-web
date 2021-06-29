@extends('admin.templates.app')
@section('title', 'Thêm danh mục')
@section('main-content')
    <!-- start page title -->
    <div class="page-title-box"  style="padding-top:45px">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h4>Thêm danh mục mới</h4>
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
                            <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data" class="form-control border-0">
                                @csrf
                                {{-- @method('PUT') --}}
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-4 col-lg-3 col-form-label">Tên danh mục</label>
                                    <div class="col-sm-5 col-md-4">
                                        <input class="form-control" value="{{old('name')}}" name="name" type="text" placeholder="Nhập tên danh mục" id="example-text-input" required>
                                        @error('name')
                                            <p class="text-danger mb-0 mt-2" style="font-size: 13px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-search-input" class="col-sm-4 col-form-label col-lg-3">Trạng thái</label>
                                    <div class="col-sm-5 col-md-4">
                                        <label for="stt1" class="col-form-label">Hiển thị</label>
                                        <input id="stt1" name="active" value="1" type="radio" checked>
                                        <label for="stt2" class="mx-2 col-form-label">Không hiển thị</label>
                                        <input id="stt2" name="active" value="0" type="radio">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-primary waves-effect waves-light">Xác nhận</button>
                                @error('failedMessage')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div> <!-- container-fluid -->
    <script>

    </script>
@endsection