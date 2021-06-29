<header id="page-topbar">
	<div class="navbar-header">
		<div class="d-flex">
		<!-- LOGO -->
		<div class="navbar-brand-box">
			<a href="{{route('home')}}" class="logo logo-dark">
				<i class="mdi mdi-arrow-left-bold-box-outline" style="font-size: 30px; color:#000"></i>
				{{-- <span class="logo-sm">
					<img src="{{asset('admin/images/logo-sm.png')}}" alt="" height="22">
				</span>
				<span class="logo-lg">
					<img src="{{asset('admin/images/logo-dark.png')}}" alt="" height="20">
				</span> --}}
			</a>
			{{-- <a href="{{route('home')}}" class="logo logo-light">
				<span class="logo-sm">
					<img src="{{asset('admin/images/logo-sm.png')}}" alt="" height="22">
				</span>
				<span class="logo-lg">
					<img src="{{asset('admin/images/logo-light.png')}}" alt="" height="20">
				</span>
			</a> --}}
		</div>

			<button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
				<i class="mdi mdi-menu"></i>
			</button>
		</div>

		<div class="d-flex">
			<div class="dropdown d-none d-lg-inline-block ms-1">
				<button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
					<i class="mdi mdi-fullscreen"></i>
				</button>
			</div>

			<div class="dropdown d-inline-block">
				<button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
					data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="mdi mdi-bell-outline bx-tada"></i>
					<span class="badge bg-danger rounded-pill"></span>
				</button>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
					aria-labelledby="page-header-notifications-dropdown">
					<div class="p-3">
						<div class="row align-items-center">
							<div class="col">
								<h6 class="m-0"> Thông báo </h6>
							</div>
							<div class="col-auto">
								<a href="#!" class="small"> Xem tất cả</a>
							</div>
						</div>
					</div>
					<div data-simplebar style="max-height: 230px;">
						<a href="" class="text-reset notification-item">
							<div class="media">
								<div class="avatar-xs me-3">
									<span class="avatar-title bg-primary rounded-circle font-size-16">
										<i class="mdi mdi-cart text-white"></i>
									</span>
								</div>
								<div class="media-body">
									<h6 class="mt-0 mb-1">Chức năng chưa được kích hoạt</h6>
									<div class="font-size-13 text-muted">
										<p class="mb-1"></p>
										<p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="p-2 border-top">
						<a class="btn btn-sm btn-link font-size-14 w-100 text-center" href="javascript:void(0)">
							<i class="mdi mdi-arrow-right-circle me-1"></i> Xem thêm
						</a>
					</div>
				</div>
			</div>

			<div class="dropdown d-inline-block">
				<button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
					data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<img class="rounded-circle header-profile-user" src="{{asset(Auth::user()->avatar ?? config('constants.image.avatar'))}}"
						alt="Header Avatar">
					<span class="d-none d-xl-inline-block ms-1">{{Auth::user()->name}}</span>
					<i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
				</button>
				<div class="dropdown-menu dropdown-menu-end">
					<!-- item-->
					<a class="dropdown-item" href="{{route('admin.show', ['admin'=>Auth::user()->id])}}"><i class="mdi mdi-account-circle-outline font-size-16 align-middle me-1"></i>Thông tin cá nhân </a>
					<a class="dropdown-item d-block" href="{{route('change-password')}}"><span class="badge badge-success float-end">11</span><i class="mdi mdi-cog-outline font-size-16 align-middle me-1"></i> Đổi mật khẩu</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item text-danger" href="{{route('logout')}}"><i class="mdi mdi-power font-size-16 align-middle me-1 text-danger"></i> Đăng xuất</a>
				</div>
			</div>
		</div>
	</div>
</header>