@extends('admin.templates.app')
@section('title', 'Sửa sản phẩm')
@push('css')
    <style>
        .remove-image {
            display: none;
            position: absolute;
            top: -10px;
            right: -10px;
            border-radius: 10em;
            padding: 2px 6px 3px;
            text-decoration: none;
            font: 700 21px/20px sans-serif;
            background: #555;
            border: 3px solid #fff;
            color: #FFF;
            box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 2px 4px rgba(0,0,0,0.3);
            text-shadow: 0 1px 2px rgba(0,0,0,0.5);
            -webkit-transition: background 0.5s;
            transition: background 0.5s;
        }
        .remove-image:hover {
            color: #fff;
            background: #E54E4E;
            padding: 3px 7px 5px;
            top: -11px;
            right: -11px;
        }
        .remove-image:active {
            background: #E54E4E;
            top: -10px;
            right: -11px;
        }
    </style>
	<!-- select2 css -->
    <script src="{{asset('admin/libs/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('admin/libs/ckeditor/ckfinder/ckfinder.js')}}"></script>
     <!-- Sweet Alerts js -->
    <script src="{{asset('admin/libs/sweetalert2/sweetalert.min.js')}}"></script>
    <link href="{{asset('admin/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('main-content')
<!-- start page title -->
    <div class="page-title-box"  style="padding-top:45px">
        <div class="container-fluid">
         <div class="row align-items-center">
             <div class="col-sm-6">
                 <div class="page-title">
                     <h4>Sửa sản phảm</h4>
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
                            <div id="addproduct-nav-pills-wizard" class="twitter-bs-wizard">
                                <form id="editProductForm" class="add-form" action="{{route('admin.product.update', ['product'=>$product->id])}}" method="post">
                                    @method('put')
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-12">
                                            <label class="form-label" for="radio" >Đăng bán</label>
                                            <input id="radio" name="active" value="1" type="radio" {{$product->active ? 'checked' : ''}}>
                                            <span class="mx-3"></span>
                                            <label class="form-label" for="radio2">Ẩn đi</label>
                                            <input id="radio2" name="active" value="0" type="radio" {{$product->active ? '' : 'checked'}}>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="productname">Tên sản phẩm</label>
                                            <input id="productname" name="name" value="{{$product->name}}" type="text" class="form-control" required>
                                            @error('name')
                                                <p class="mb-0 mt-1 text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="control-label">Danh mục sản phẩm</label>
                                                <select class="form-control select2" name="category_id" required>
                                                @if(count($categories) > 0)
                                                    <option value=''>Lựa chọn</option>
                                                    @foreach ($categories as $cate)
                                                        <option value="{{$cate->id}}" {{$cate->id == $product->category_id ? 'selected' : ''}}>{{$cate->name}}</option>
                                                    @endforeach
                                                @endif
                                                </select>
                                                @error('slug')
                                                    <p class="mb-0 mt-1 text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="price">Giá tiền</label>
                                                <input id="price" name="price" value="{{$product->price}}" type="number" min="0" class="form-control" required>
                                                @error('price')
                                                    <p class="mb-0 mt-1 text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="short_description">Mô tả ngắn</label>
                                                <textarea name="short_description" rows="5" id="short_description" class="form-control">{{$product->short_description ?? ''}}</textarea>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="form-label" for="price">Mô tả chi tiết</label>
                                             <textarea style="height:" rows="20" name="description" id="description">{{$product->description ?? ''}}</textarea>
                                            <script>
                                                var editor = CKEDITOR.replace('description');
                                            </script>
                                        </div>
                                        <input id="btnSubmit" type="submit" style="display:none">
                                    </div>
                                </form>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body px-0">
            
                                            <h4 class="header-title">Hình ảnh cũ</h4>
                                            <p class="card-title-desc">Xóa hoặc tiếp tục sử dụng.
                                            </p>
                                            @if(count($picture) > 0)
                                                <div class="row">
                                                @foreach ($picture as $img)
                                                    <div class="m-2 text-center p-0 img-thumbnail w-auto">
                                                        <img src="{{asset($img->small)}}" class="img-fuild" alt="Preview">
                                                        <a class="remove-image" href="javascript:void(0)" data-id="{{$img->id}}" style="display: inline;">&#215;</a>
                                                    </div>
                                                @endforeach
                                                </div>
                                            @else
                                                <p>Không có hình ảnh</p>
                                            @endif
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body px-0">
                                            <h4 class="header-title">Thêm hình ảnh</h4>
                                            <p class="card-title-desc">Có thể thêm hình ảnh mới hoặc sử dụng hình ảnh cũ.
                                            </p>
            
                                            <div>
                                                <form id="mydropzone" action="{{route('picture-upload')}}" method="post" class="dropzone">
                                                    @csrf
                                                    <div class="fallback">
                                                        <input name="file" type="file" multiple="multiple">
                                                    </div>
                                                    <div class="dz-message needsclick">
                                                        <div class="mb-3">
                                                            <i class="display-4 text-muted mdi mdi-cloud-upload-outline"></i>
                                                        </div>
                                                        @error('small')
                                                            <h4 class="text-danger">{{$message}}</h4>
                                                        @enderror
                                                        <h4>Nhấp chọn hoặc kéo thả hình ảnh</h4>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div> <!-- end col -->
                                <div class="text-center mt-4 float-right">
                                    <button id="submit" type="button" class="btn btn-primary waves-effect waves-light">Lưu thay đổi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div> <!-- container-fluid -->
    @if(session('failed'))
        <script>
            swal("{{session('failed')}}","", "warning");
        </script>
    @endif
    <input id="deleteRoute" type="hidden" value="{{route('picture-delete')}}"/>
 @endsection

@push('script')
    <!-- dropzone plugin -->
	<script src="{{asset('admin/libs/dropzone/min/dropzone.min.js')}}"></script>
    <script src="{{asset('admin/js/product.js')}}"></script>
@endpush
