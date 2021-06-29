<!-- MobileMenu -->
<div class="mobile-menu-wrapper">
    <div class="mobile-menu-overlay">
    </div>
    <!-- End of Overlay -->
    <a class="mobile-menu-close" href="#"><i class="d-icon-times"></i></a>
    <!-- End of CloseButton -->
    <div class="mobile-menu-container scrollable">
        <form action="#" class="input-wrapper">
            <input type="text" class="form-control" name="search" autocomplete="off"
                placeholder="Nhập để tìm kiếm..." required />
            <button class="btn btn-search" type="submit">
                <i class="d-icon-search"></i>
            </button>
        </form>
		<ul class="mobile-menu mmenu-anim">
			@if(!isset($slug))
            	<li class="mobile-active">
			@else
				<li>
			@endif
				<a href="{{route('home')}}">Trang Chủ</a>
			</li>

			@if(isset($data) && count($data['categories']) > 0)
                @php $categories = $data['categories'] @endphp
                @foreach ($categories as $category)
                    @if (isset($slug) && $slug == $category->slug)
                        <li class="mobile-active"><a href="{{route('category', ['slug' => $category->slug])}}">{{$category->name}}</a></li>
                    @else
                        <li><a href="{{route('category', ['slug' => $category->slug])}}">{{$category->name}}</a></li>
                    @endif
                @endforeach
            @endif
			{{-- <li><a href="about-us.html">Liên Hệ</a></li> --}}
            @if(Auth::check())
                <li><a href="{{route('admin.index')}}" style="color: #ffa372"><i class="fas fa-user mr-1"></i>Trang quản trị</a></li> 
                <li><a href="{{route('login')}}" style="color: #ffa372"><i class="fas fa-sign-out-alt mr-1"></i>Đăng xuất</a></li>
            @endif
		</ul>
       <!-- End of MobileMenu -->
	</div>	
</div>