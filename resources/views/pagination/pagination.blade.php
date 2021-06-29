@if(isset($paginator) && $paginator->hasPages())
    <div class="pagination-container wow zoomIn mar-b-1x" data-wow-duration="0.5s">
        <ul class="pagination">
            

            @if($paginator->onFirstPage())
                <li class="pagination-item--wide first"> <a class="pagination-link--wide first"><i class="fas fa-arrow-circle-left"></i></a></li>
            @else
                <li class="pagination-item--wide first"> <a class="pagination-link--wide first" href="{{$paginator->previousPageUrl()}}"><i class="fas fa-arrow-circle-left"></i></a></li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="pagination-item disabled"><a class="pagination-link">{{$element}}</a></li>
                @endif

                @if(is_array($element))
                    @foreach($element as $page => $url)
                        @if($page == $paginator->currentPage())
                            <li class="pagination-item is-active"> <a class="pagination-link" href="{{$url}}">{{$page}}</a> </li>
                        @else
                            <li class="pagination-item"> <a class="pagination-link" href="{{$url}}">{{$page}}</a> </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if($paginator->hasMorePages())
                <li class="pagination-item--wide last"> <a class="pagination-link--wide last" href="{{$paginator->nextPageUrl()}}"><i class="fas fa-arrow-circle-right"></i></a> </li>
            @endif
        </ul>
    </div>
@endif

<style>
.pagination-item {
	list-style-type: none;
	display: inline-block;
	border-right: 1px solid #d7dadb;
    box-sizing: border-box;

	transform: scale(1) rotate(19deg) translateX(0px) translateY(0px) skewX(-10deg) skewY(-20deg);
}

.pagination-item:hover,
.pagination-item.is-active {
    background-color: #ffa372;
    border-right: 1px solid #fff;
    border-left: 1px solid #fff;
    font-weight: bold;
    box-sizing: border-box;
}
.pagination-item:hover .pagination-link {
    color: #212121;
    box-sizing: border-box;
}

ul.pagination li:nth-child(2) {
    border-left: 1px solid #d7dadb;
}

.pagination-link {
	padding: 1.1em 1.6em;
	display: inline-block;
	text-decoration: none;
	color: #212121;

	transform: scale(1) rotate(0deg) translateX(0px) translateY(0px) skewX(20deg) skewY(0deg);
}

.pagination-item--wide {
	list-style-type: none;
	display: inline-block;
    box-sizing: border-box;
}

.pagination-item--wide i {
    color: #444444;
}

.pagination-item--wide.first,
.pagination-item--wide.last {
	font-size: 1.7em
}

.pagination-item--wide.first {
    padding-right: 1.1em;
}

.pagination-item--wide.last {
    padding-left: 1.1em;
}

.pagination-link--wide {
	text-decoration: none;
	color: #212121;
}

.pagination-link--wide:hover {
	color: #ffa372;
}

@media screen and (max-width: 768px) {
    .pagination-link {
        padding: 0.5em 1em;
    }
}
</style>