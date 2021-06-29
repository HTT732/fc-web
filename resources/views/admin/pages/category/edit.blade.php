@extends('admin.templates.app')
@section('title', 'Sửa danh mục')
@section('main-content')
    <!-- start page title -->
    <div class="page-title-box" style="padding-top:45px">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h4>Sửa danh mục</h4>
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
                        @error('failed')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        <p class="fw-bold text-success">
                            {{session('success') ?? ''}}
                        </p>
                        @if($category)
                            <form method="post" action="{{route('admin.category.update', ['category'=>$category->id])}}" class="form-control border-0">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-4 col-lg-3 col-form-label">Tên danh mục</label>
                                    <div class="col-sm-5 col-md-4">
                                        <input class="form-control" value="{{$category->name}}" name="name" type="text" placeholder="Nhập tên danh mục" id="example-text-input">
                                        @error('name')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-search-input" class="col-sm-4 col-form-label col-lg-3">Trạng thái</label>
                                    <div class="col-sm-5 col-md-4">
                                        <input id="stt1" name="active" value="1" type="radio" {{$category->active ? 'checked' : ''}}>
                                        <label for="stt1" class="col-form-label ">Hiển thị</label>
                                        <i class="mx-2"></i>
                                        <input id="stt2" name="active" value="0" type="radio" {{!$category->active ? 'checked' : ''}}>
                                         <label for="stt2" class="mx-2 col-form-label">Không hiển thị</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-primary waves-effect waves-light">Xác nhận</button>
                            </form>
                        @else
                            <p>Không có danh mục sản phẩm.</p>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div> <!-- container-fluid -->
@endsection