@extends('admin.templates.app')
@section('title', 'Quản lý tổng quan')
@section('preloader')
	@include('admin.layouts.preloader')
@endsection
@section('main-content')
	<div class="page-title-box" style="padding-top: 45px;">
		<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-sm-6">
				<div class="page-title">
					<h4>Quản lý tổng quan</h4>
				</div>
			</div>
		</div>
		</div>
	</div>
	<!-- end page title -->    
	<div class="container-fluid">
		<div class="page-content-wrapper">
			<div class="row">
				<div class="col-xl-12">
					<div class="row">
						<div class="col-xl-4 col-md-6">
							<div class="card">
								<a href="{{route('admin.product.index')}}">
									<div class="card-body">
										<div class="text-center">
											<p class="font-size-16">SẢN PHẨM</p>
											<div class="mini-stat-icon mx-auto mb-4 mt-3">
												<span class="avatar-title rounded-circle bg-soft-primary">
														<i class="mdi dripicons-store text-primary font-size-20"></i>
													</span>
											</div>
											<h5 class="font-size-22">{{$data['productCount'] ?? 0}}</h5>

											<div class="progress mt-3" style="height: 4px;">
												<div class="progress-bar progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
												</div>
												
											</div>
										</div>

									</div>
								</a>
							</div>
						</div>

						<div class="col-xl-4 col-md-6">
							<div class="card">
								<a href="{{route('admin.order.index')}}">
									<div class="card-body">
										<div class="text-center">
											<p class="font-size-16">ĐƠN HÀNG</p>
											<div class="mini-stat-icon mx-auto mb-4 mt-3">
												<span class="avatar-title rounded-circle bg-soft-danger">
														<i class="mdi mdi-cart-outline text-danger font-size-20"></i>
													</span>
											</div>
											<h5 class="font-size-22">{{$data['orderCount'] ?? 0}}</h5>

											<div class="progress mt-3" style="height: 4px;">
												<div class="progress-bar progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="80">
												</div>
												
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
						<div class="col-xl-4 col-md-6">
							<div class="card">
								<a href="{{route('admin.category.index')}}">
									<div class="card-body">
										<div class="text-center">
											<p class="font-size-16">DANH MỤC SẢN PHẨM</p>
											<div class="mini-stat-icon mx-auto mb-4 mt-3">
												<span class="avatar-title rounded-circle bg-soft-warning">
														<i class="mdi mdi-order-bool-descending text-warning font-size-20"></i>
													</span>
											</div>
											<h5 class="font-size-22">{{$data['cateCount'] ?? 0}}</h5>

											<div class="progress mt-3" style="height: 4px;">
												<div class="progress-bar progress-bar bg-warning" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="80">
												</div>
												
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
				@if(count($data['banner']) > 0)
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
								<div class="carousel-indicators">
									@foreach ($data['banner'] as $index => $item)
										<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$index}}}" class="{{$index == 0 ? 'active' : ''}}" aria-current="true" aria-label="Slide {{$index}}"></button>
									@endforeach
								</div>
								<div class="carousel-inner">
								@foreach ($data['banner'] as $index => $item)
									<div class="carousel-item {{$index == 0 ? 'active' : ''}}">
										<div class="row align-items-center mb-5">
											<div class="col-12">
												<img src="{{asset($item->original_url)}}"
													class="img-fluid me-3" alt="banner">
											</div>
										</div>
									</div>
								@endforeach
								</div>
								<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Previous</span>
								</button>
								<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Next</span>
								</button>
							</div>
						</div>
					</div>
				</div>
				@endif
			</div>
		</div>
	</div> <!-- container-fluid -->
@endsection