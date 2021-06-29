@extends('admin.templates.app')
@section('title',"Thêm sản phẩm")
@push('css')
	<!-- twitter-bootstrap-wizard css -->
	<link rel="stylesheet" href="{{asset('admin/libs/twitter-bootstrap-wizard/prettify.css')}}">

	<!-- select2 css -->
	<link href="{{asset('admin/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

	<!-- dropzone css -->
	<link href="{{asset('admin/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />

    <script src="{{asset('admin/libs/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('admin/libs/ckeditor/ckfinder/ckfinder.js')}}"></script>
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
                     <h4>Thêm sản phẩm mới</h4>
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
                                <form id="addProductForm" class="add-form" action="{{route('admin.product.store')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="productname">Tên sản phẩm</label>
                                            <input id="productname" name="name" value="{{old('name')}}" type="text" class="form-control" required>
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
                                                        <option value="{{$cate->id}}" {{$cate->id == old('id') ? 'selected' : ''}}>{{$cate->name}}</option>
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
                                                <input id="price" name="price" value="{{old('price')}}" type="number" min="0" class="form-control" required>
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
                                             <textarea style="height:" rows="20" name="description" id="description">{{old('description')}}</textarea>
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
                                            <h4 class="header-title">Hình ảnh</h4>
                                            <p class="card-title-desc">Tải lên một hoặc nhiều hình ảnh của sản phẩm để hiển thị.
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
                                    <button id="submit" type="submit" class="btn btn-primary waves-effect waves-light">Lưu sản phẩm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div> <!-- container-fluid -->
    @if (session('success'))
        <script>
            swal("{{session('success')}}","", "success");
        </script>
    @endif
    @if(session('failed'))
        <script>
            swal("{{session('failed')}}","", "warning");
        </script>
    @endif

    <input id="deleteRoute" type="hidden" value="{{route('picture-delete')}}"/>
 @endsection

     
@push('script')
	<!-- twitter-bootstrap-wizard js -->
	<script src="{{asset('admin/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>

	<script src="{{asset('admin/libs/twitter-bootstrap-wizard/prettify.js')}}"></script>

	<!-- select 2 plugin -->
	<script src="{{asset('admin/libs/select2/js/select2.min.js')}}"></script>

	<!-- dropzone plugin -->
	<script src="{{asset('admin/libs/dropzone/min/dropzone.min.js')}}"></script>

    <script src="{{asset('admin/js/product.js')}}"></script>
@endpush
