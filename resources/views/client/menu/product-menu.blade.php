<div class="toolbox">
    <div class="toolbox-left">
        <ul class="nav-filters menu-product" data-target="#products-grid">
            @if(!isset($slug))
                <li><a href="#" class="nav-filter active font-weight-semi-bold"
                    data-filter="*">Tất cả sản phẩm</a></li>
            @endif

            @if(count($data['categories']) > 0)
                @php $categories = $data['categories'] @endphp
                @foreach ($categories as $cate)
                    @if(isset($slug) && $slug == $cate->slug)
                        <li>
                            <a href="{{route('category', ['slug' => $cate->slug])}}" class="active nav-filter font-weight-semi-bold">
                                {{ $cate->name }}
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        </ul>
        <span class="divider"></span>
        <div class="header-search hs-toggle">
            <a href="javascript:void(0)" class="search-toggle">
                <i class="d-icon-search"></i>Tìm kiếm
            </a>
            <form action="{{route('filter')}}" class="input-wrapper" method="get">
                @csrf
                <input type="text" class="form-control" name="search" autocomplete="off"
                    placeholder="Tìm kiếm sản phẩm..." required />
                <button class="btn btn-search" type="submit">
                    <i class="d-icon-search"></i>
                </button>
            </form>
        </div>
        <!-- End of Header Search -->
    </div>
    <div class="toolbox-right">
        <a href="#" class="btn btn-link  right-sidebar-toggle font-weight-semi-bold mr-0"><i
                class="d-icon-filter-3"></i>Lọc Sản Phẩm</a>
    </div>
</div>