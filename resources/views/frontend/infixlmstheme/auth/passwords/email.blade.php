@extends('frontend.infixlmstheme.auth.layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Fav icon -->
  <link rel="icon" type="image/png" href="public/frontend/infixlmstheme/img/banner/fav-icon.png">
  <title>{{ Settings('site_title') . " - إعادة تعيين كلمة السر" }}</title>
</head>
<body>
    <div class="main" style="direction: rtl; font-family: Bahij">
      <div class="container min-vh-100">
        <div class="row min-vh-75 align-items-center">
          <div class="col-lg-6 offset-lg-1 pt-5">
            <span class="py-2 px-4 rounded-pill bg-light" style="color: #07487c"
              >مرحبا بك</span
            >
            <h1 class="mt-2 mb-2" >{{ 'في منصة ' . Settings('site_title')}}</h1>
            <p class="text-title">سجل دخولك حتي تتمكن من استخدم المنصة</p>
            <img src="public/frontend/infixlmstheme/img/banner/global.png"  class="img-fluid pt-3 d-none d-lg-block" />

          </div>
          <div class="col-lg-5" style="margin-top: 50px">

            <!-- End OF LAYOUT it is static structure in all Auth code -->

            <div class="px-3 pt-5">
              <div class="bg-light rounded-4 pt-5 px-4 pb-3">
                <p class="py-2 pt-4 pb-2"> إرسال الكود الي البريد الالكتروني </p>

                @if (session('status'))

                    <span class="text-success text-center p-3 d-block" role="alert">
                                                <strong> {{ session('status') }}</strong>
                                            </span>
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <span class="invalid-feedback text-center p-3 d-block" role="alert">
                                                <strong>{{ $error}}</strong>
                                            </span>
                    @endforeach
                @endif
                <form  action="{{route('password.email')}}" method="POST">
                @csrf

                  <div class="input pb-3">
                    <div class="input-container">
                      <i class="icon"><img src="/public/frontend/infixlmstheme/img/banner/email.svg" /></i>
                      <input
                        type="email"
                        class="input-field form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                        placeholder="البريد الالكتروني"
                        value="{{old('email')}}"
                        placeholder="{{__('common.Enter Email')}}" name="email" aria-label="Username"
                                       aria-describedby="basic-addon3"/>



                    </div>
                  </div>
                  <div class="mt-3 login mb-5 pb-4">
                    <button class="btn w-100 mb-5">
                      <span>التالي</span>
                      <span><i class="fas fa-spinner fa-spin"></i></span>
                    </button>
                  </div>
                </form>
              </div>
              <div class="mt-5 pt-4 notExist">
                <p>
                  لا تمتلك حسايبا؟
                  <a href="{{route('register')}}" style="text-decoration: underline; color: #07487c">تسجيل جديد</a>
                </p>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>

   <!--  <h5 class="shitch_text">
                <a href="{{route('register')}}">{{__('common.Need an account?')}}</a>

            </h5> -->
        </div>
        <!-- @include('frontend.infixlmstheme.auth.login_wrapper_right') -->

    </div>
