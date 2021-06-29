 <div class="header-right">
    @if(Auth::check())
        <a class="mr-0 d-lg-show" href="{{route('admin.index')}}" style="color: #ffa372"><i class="fas fa-user mr-1"></i>Trang quản trị</a>
        <span class="delimiter font-weight-normal ml-2 mr-2 d-lg-show"></span>
        <a class="mr-0 d-lg-show" href="{{route('logout')}}" style="color: #ffa372"><i class="fas fa-sign-out-alt mr-1"></i>Đăng xuất</a>
        
    @endif
    <span class="delimiter font-weight-normal ml-2 mr-2 d-lg-show"></span>
    <!-- End of Login -->
    <div class="dropdown cart-dropdown cart-offcanvas">
        <a href="#" class="cart-toggle">
            <span class="cart-label d-lg-show">
                @php
                    $count = 0;
                    foreach ($data['product_orders'] as $detail) {
                        $count += $detail->order->quanlity;
                    }
                @endphp
            </span>
            <i class="d-icon-bag"><span class="cart-count">{{ $count }}</span></i>
        </a>
        <!-- End of Cart Toggle -->
        <div class="cart-overlay"></div>
        <!-- End Cart Toggle -->

        @include('client.popup.dropdown-box-cart')
        <!-- End Dropdown Box -->
    </div>

    <div class="header-search hs-toggle mobile-search">
        <a href="#" class="search-toggle">
            <i class="d-icon-search"></i>
        </a>
        <form action="#" class="input-wrapper">
            <input type="text" class="form-control" name="search" autocomplete="off"
                placeholder="Search your keyword..." required />
            <button class="btn btn-search" type="submit">
                <i class="d-icon-search"></i>
            </button>
        </form>
    </div>
    <!-- End of Header Search -->
</div>