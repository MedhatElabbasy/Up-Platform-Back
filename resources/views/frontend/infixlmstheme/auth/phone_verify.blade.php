<!-- @extends('frontend.infixlmstheme.auth.layouts.app') -->
<link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/app.css">
<link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/frontend_style.css">
@section('content')
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/app.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/frontend_style.css">
    <style>
        .error_wrapper{
            padding: 243px 0 250px 0;

        }
    </style>

    <div class="error_wrapper">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-12">
                    <div class="error_wrapper_info text-center">
                        <div class="thumb">
                            <img src="{{asset('/public/infixlmstheme/')}}/img/banner/error_thumb.png" alt="">
                        </div>
                        <h3>{{ __('frontend.Verify Your phone') }}</h3>
                        @if (session('resent'))
                            <p>{{ __('frontend.A fresh verification code has been sent to your phone') }}</p>

                        @endif
                        <br>

                        <form action="{{route('activateWithOtp')}}" method="POST" id="loginForm">
                            @csrf

                            <div class="input pb-3">
                                <div class="input-container">
                                    <i class="icon"><img src="public/frontend/infixlmstheme/img/banner/email.svg" /></i>
                                    <input type="text" value="" class="input-field "   placeholder="{{__('ادخل كود التحقق')}}" name="code" aria-label="Username"
                                           aria-describedby="basic-addon3">
                                </div>
                            </div>
                        </form>

                        <p class="mb-2 h6">
                            {{ __('frontend.Before proceeding, please check your phone for a verification code Login') }}
                        </p>
                        <form method="POST" class="" action="{{ route('verification_mail_resend') }}">
                            @csrf
                            <div class="">
                                <button type="submit" class="theme_btn">
                                    {{ __('frontend.Resend Code') }}
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
