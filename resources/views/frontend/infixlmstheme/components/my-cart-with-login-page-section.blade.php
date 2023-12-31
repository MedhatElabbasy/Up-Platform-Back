<div>
    <div class="cart_wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="new_cart_wrapper">
                        <h4>{{__('coupons.My Cart')}}</h4>

                        @if(count($carts)==0)
                            <div class="col-lg-12">
                                <h3 class="text-center text-secondary"> {{__('common.No Item found')}} <i
                                        class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </h3>
                            </div>
                        @else
                            @php $totalSum=0; @endphp

                            @if(isset($carts))
                                @foreach ($carts as $key=>$cart)
                                    @php

                                        if ($cart->type=='bundle'){
                                         $thumbnail=$cart->bundle->thumbnail ?? Settings('logo');
                                          $price=$cart->bundle->price;
                                          $link=route('bundle.show').'?id='.$cart->bundle_course_id;
                                           $title =$cart->bundle->title;
                                           $type='bundle';
                                        }elseif ($cart->type=='event'){
                                            $thumbnail=Settings('logo');
                                            $price=$cart->event->price;
                                            $link=null;
                                           $title =$cart->event->title;
                                           $type='event';
                                        }else{
                                            $thumbnail =$cart->course->thumbnail ?? Settings('logo');
                                            $link =route('courseDetailsView',$cart->course->slug);
                                            $title =$cart->course->title;
                                            if (isModuleActive('Installment') && $cart->is_installment == 1) {
                                                $price=installmentProductPrice($cart->course_id, $cart->plan_id);
                                            }else{
                                                if ($cart->course->discount_price!=null) {
                                                    $price = $cart->course->discount_price;
                                                } else {
                                                    $price = $cart->course->price;
                                                }
                                            }
                                           $type='course';
                                        }

                                       $totalSum =  $totalSum + @$price;

                                    @endphp

                                    <div class="single_cart">
                                        <div class="product_name d-flex align-items-center">
                                            <a href="{{route('removeItem',[$cart->id])}}">
                                                <div class="">

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         viewBox="0 0 16 16">
                                                        <path data-name="Path 174" d="M0,0H16V16H0Z" fill="none"/>
                                                        <path data-name="Path 175"
                                                              d="M14.95,6l-1-1L9.975,8.973,6,5,5,6,8.973,9.975,5,13.948l1,1,3.973-3.973,3.973,3.973,1-1L10.977,9.975Z"
                                                              transform="translate(-1.975 -1.975)"
                                                              fill="var(--system_primery_color)"/>
                                                    </svg>
                                                </div>
                                            </a>
                                            <div class="thumb">
                                                <img src="{{asset($thumbnail)}}" alt="">
                                            </div>
                                            <span class="text-justify">
                                            <a href="{{$link}}">
                                            <h5>{{$title}}</h5>
                                            <span class="badge badge-info">
                                                @switch($type)
                                                    @case('bundle')
                                                    <span>مسار تعليمي</span>
                                                        @break
                                                    @case('event')
                                                    <span>فعالية</span>
                                                        @break
                                                    @default
                                                    @if(!$cart->class_id)
                                                    <span>مكتبة المهارات</span>
                                                    @else
                                                    <span>دورة اونلاين</span>
                                                    @endif
                                                @endswitch
                                                </span>
                                        </a>
                                        </span>
                                        </div>

                                        <div class="f_w_400">{{getPriceFormat($price)}}</div>
                                    </div>
                                @endforeach
                            @endif

                        @endif
                    </div>
                    <div class="cart_table_wrapper mb-0">
                        @if(count($carts)!=0)
                            <div class="row mt_30">
                                <div class="col-12 text-right">
                                    <a href="{{route('CheckOut')}}"
                                       class="theme_btn">{{__('student.Proceed to checkout')}}</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
