<section
    class=" owl-carousel owl-theme row owl-dot-inner  owl-nav-arrow cols-1"
    data-owl-options="{
    'items': 1,
    'nav': false,
    'loop': true,
    'dots': true,
    'autoplay': true,
    'autoplayTimeout':3000,
    'responsive': {
        '1360': {
            'nav': true
	        }
	    }
	}">
    
    @if(isset($data) && count($data['sliders']) > 0)
    @php $sliders = $data['sliders'] @endphp
        @foreach ($sliders as $slider)
            <div class="intro-slide1 banner banner-fixed" style="background-color: #f6f6f6">
            <figure>
                <img src="{{asset($slider->original_url)}}" alt="Banner" width="1903" height="650" />
            </figure>
        </div>
        @endforeach
    @endif
    </div>
</section>