<div class="vertical-menu">
	<div data-simplebar class="h-100">
		<div class="user-sidebar text-center">
			<div class="dropdown">
				<div class="user-img">
					<img src="{{asset(Auth::user()->avatar ?? config('constants.image.avatar'))}}" alt="avatar" class="rounded-circle">
					<span class="avatar-online bg-success"></span>
				</div>
				<div class="user-info">
					<h5 class="mt-3 font-size-16 text-white">{{Auth::user()->name}}</h5>
					<span class="font-size-13 text-white-50">Quản trị viên</span>
				</div>
			</div>
		</div>

		<!--- Sidemenu -->
		<div id="sidebar-menu">
			<!-- Left Menu Start -->
			<ul class="metismenu list-unstyled" id="side-menu">
				<li class="mt-2"></li>
				<li>
					<a href="{{route('admin.index')}}" class="waves-effect">
						<i class="dripicons-home"></i>
						<span>Tổng quan</span>
					</a>
				</li>
				<li class="li-product">
					<a href="{{route('admin.product.index')}}" class="waves-effect">
						<i class="dripicons-calendar"></i>
						<span>Sản phẩm</span>
					</a>
				</li>
				<li class="li-order">
					<a href="{{route('admin.order.index')}}" class="waves-effect">
						<i class="dripicons-cart"></i>
						<span>Đơn đặt hàng</span>
					</a>
				</li>
				<li class="li-category">
					<a href="{{route('admin.category.index')}}" class=" waves-effect">
						<i class="dripicons-list"></i>
						<span>Danh mục sản phẩm</span>
					</a>
				</li>
				<li class="li-banner">
					<a href="{{route('admin.banner.index')}}" class=" waves-effect">
						<i class="dripicons-photo-group"></i>
						<span>Banner</span>
					</a>
				</li>
			</ul>
		</div>
		<!-- Sidebar -->
	</div>
</div>