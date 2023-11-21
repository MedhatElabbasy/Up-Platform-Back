<div class="banner-slider owl-carousel">
    @if(isset($result))
        @foreach($result as $key=>$slider)
            <div class="banner-area">
                <div class="banner-img">
                    <img src="{{asset(@$slider->image)}}" alt="">
                </div>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-7 col-lg-8 col-md-9">
                            <div class="banner-text">
                                <h1 class="text-white">{{ @$slider->title }}</h1>
                                <p class="pe-0 pe-xl-5 text-white">{{ @$slider->sub_title }}</p>
                                {{--                                <a href="{{route('courses')}}" class="theme-btn text-capitalize">Get Started <i--}}
                                {{--                                        class="fa fa-arrow-right ms-3"></i></a>--}}
                                {{--                                <a href="{{route('courses')}}" class="theme-btn text-capitalize bg-transparent">Learn--}}
                                {{--                                    more</a>--}}

                                @if($slider->btn_type1==1)
                                    @if(!empty($slider->btn_title1))
                                        <div class="single_slider d-inline-block">
                                            <a href="{{$slider->btn_link1}}"
                                               class="theme-btn text-capitalize">{{$slider->btn_title1}}</a>
                                        </div>
                                    @endif
                                @else
                                    <div class="single_slider d-inline-block">
                                        <a href="{{$slider->btn_link1}}">
                                            <img
                                                src="{{asset($slider->btn_image1)}}"
                                                alt="">

                                        </a>
                                    </div>
                                @endif
                                @if($slider->btn_type2==1)
                                    @if(!empty($slider->btn_title2))
                                        <div class="single_slider d-inline-block">
                                            <a href="{{$slider->btn_link2}}"
                                               class="theme-btn text-capitalize bg-transparent">{{$slider->btn_title2}}</a>
                                        </div>
                                    @endif
                                @else
                                    <div class="single_slider d-inline-block">
                                        <a href="{{$slider->btn_link2}}">
                                            <img
                                                src="{{asset($slider->btn_image2)}}"
                                                alt="">

                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

<script>
    (function () {
        $(document).ready(function () {
            $('.banner-slider').owlCarousel({
                nav: true,
                rtl: false,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                dots: true,
                items: 1,
                lazyLoad: true,
                autoplay: false,
                autoplayHoverPause: true,
                loop: true,
                margin: 0,
            });
        })
    })();
</script>
