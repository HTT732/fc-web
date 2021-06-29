<div class="header-left">
<a href="#" class="mobile-menu-toggle">
    <i class="d-icon-bars2"></i>
</a>
<nav class="main-nav">
    <ul class="menu menu-active-underline">
        @if(!isset($slug))
            <li class="active">
        @else
            <li>
        @endif
            <a href="{{route('home')}}">Trang Chủ</a>
        </li>
        <!-- End of Dropdown -->
        
        @if(isset($data) && count($data['categories']) > 0)
            @php $categories = $data['categories'] @endphp
            @foreach ($categories as $category)
                @if (isset($slug) && $slug == $category->slug)
                    <li class="active"><a class="active" href="{{route('category', ['slug' => $category->slug])}}">{{$category->name}}</a></li>
                @else
                    <li><a href="{{route('category', ['slug' => $category->slug])}}">{{$category->name}}</a></li>
                @endif
            @endforeach
        @endif
        <!-- End of Dropdown -->
        {{-- <li>
            <a href="#">Liên Hệ</a>
        </li> --}}
    </ul>
</nav>
</div>