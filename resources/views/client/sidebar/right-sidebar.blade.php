<aside id="shopSidebar" class="right-sidebar shop-sidebar">
    <div class="sidebar-overlay"></div>
    <div class="sidebar-content">
        <form id="filterForm" action="{{isset($slug) ? route('category-filter', ['slug'=>$slug]) : route('filter')}}" method="get" enctype="multipart/form-data">
            @csrf
            <div class="filter-actions mb-4">
                <a type="submit"
                    class="sidebar-toggle-btn toggle-remain btn btn-outline btn-primary text-uppercase btn-icon-right">Lọc sản phẩm<i
                        class="d-icon-arrow-right"></i></a>
                <a id="filter-close" href="javascript:void(0)" class="filter-clean">Đóng</a>
            </div>
            <div class="sort widget widget-collapsible">
                <h3 class="widget-title">Sắp xếp theo giá</h3>
                <ul class="widget-body filter-items filter-price">
                    <li>
                        <a href="#" data-sort="asc">Giá từ thấp đến cao</a>
                    </li>
                    
                    <li>
                        <a href="#" data-sort="desc">Giá từ cao đến thấp</a>
                    </li>
                </ul>
            </div>
            <div class="filter-by-price widget widget-collapsible price-with-count">
                <h3 class="widget-title">Lọc theo giá</h3>
                <ul class="widget-body filter-items filter-price">
                    <li>
                        <a href="#" data-to="1000000">< 1,000,000</a>
                    </li>
                    
                    <li>
                        <a href="#" data-from="1000000" data-to="3000000">1,000,000 - 3,000,000</a>
                    </li>
                    <li>
                        <a href="#" data-from="3000000" data-to="5000000">3,000,000 - 5,000,000</a>
                    </li>
                    <li>
                        <a href="#" data-from="5000000">> 5,000,000</a>
                    </li>
                </ul>
            </div>
            {{-- <div class="filter-by-size widget widget-collapsible">
                <h3 class="widget-title">Lọc theo kích cỡ</h3>
                <ul class="widget-body filter-items">
                    <li><a href="#" data-val="1000000">Extra Large</a></li>
                    <li><a href="#" data-val="1000000">Large</a></li>
                    <li><a href="#" data-val="1000000">Medium</a></li>
                    <li><a href="#" data-val="1000000">Small</a></li>
                </ul>
            </div> --}}
        </form>
    </div>
</aside>