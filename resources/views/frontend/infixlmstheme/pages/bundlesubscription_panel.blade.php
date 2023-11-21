@extends(theme('layouts.dashboard_master'))
@section('title'){{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}} | {{__('common.Dashboard')}} @endsection
@section('css')
    <link href="{{ asset('public/frontend/infixlmstheme/css/class_details.css') }}" rel="stylesheet"/>
@endsection

@section('mainContent')
    <div class="main_content_iner main_content_padding text-right">

        <div class="container dashboard_lg_card">

            @foreach($data as $value)
                <div class="recommended_courses">
                    <div class="row">

                        <div class="col-12">
                            <div class="section__title3 margin_50">
                                <h3>{{ $value->title }}</h3>
                                <span class="card p-2">
                                <span style="color: red">ينتهي في : {{ $value->expire }}</span>
                                 <button class="link_value theme_btn small_btn4" style="width: fit-content"><a class="text-white" href="{{ route('bundle.renew',['bundle_id'=>$value->id]) }}"> {{__('bundleSubscription.Renew')}} </a> </button>
                                </span>
                                <p>{{ $value->about }}</p>
                            </div>
                        </div>

                        @foreach($value->course as $raw)

                            <div class="col-xl-4 col-md-6 card p4 mb-4 text-center">
                                <div class="quiz_wizged">

                                    <a href="{{route('continueCourse',[$raw->course->slug])}}">
                                        <div class="thumb">
                                            <div class="thumb_inner lazy"
                                                 data-src="{{ file_exists($raw->course->thumbnail) ? asset($raw->course->thumbnail) : asset('public/\uploads/course_sample.png') }}">

                                                <span class="prise_tag">
                                                    @if (@$raw->course->discount_price!=null)
                                                        {{getPriceFormat($raw->course->discount_price)}}
                                                    @else
                                                        {{getPriceFormat($raw->course->price)}}
                                                    @endif
                                                </span>


                                            </div>

                                        </div>
                                    </a>

                                    <div class="course_content">
                                        <a href="{{route('continueCourse',[$raw->course->slug])}}">
                                            <h4 class="noBrake"
                                                title="{{$raw->course->title}}"> {{$raw->course->title}}</h4>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

            @endforeach
            @if(count($data)==0)
                <div class="col-12">
                    <div class="section__title3 margin_50">
                        <p class="text-center">{{__('bundleSubscription.No Bundle Purchased Yet')}}!</p>
                    </div>
                </div>
            @endif

        </div>


    </div>

@endsection
@section('js')
    <script src="{{asset('public/frontend/infixlmstheme/js/class_details.js')}}"></script>
@endsection
