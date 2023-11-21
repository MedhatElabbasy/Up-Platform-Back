@extends(theme('auth.layouts.app'))
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Fav icon -->
  <link rel="icon" type="image/png" href="public/frontend/infixlmstheme/img/banner/fav-icon.png">
  <title>{{ Settings('site_title') . " - تسجيل الدخول" }}</title>
</head>
<body>
  <div class="main" style="direction: rtl; font-family: Bahij">
    <div class="container min-vh-100 py-5">
      <div class="row min-vh-75 align-items-center">
        <div class="col-lg-6 offset-lg-1 pt-3">
          <span class="py-2 px-4 rounded-pill bg-light" style="color: #07487c">مرحبا بك</span>
          <h1 class="mt-2 mb-2" >{{ 'في منصة ' . Settings('site_title')}}</h1>
          <p class="text-title">سجل دخولك حتي تتمكن من استخدم المنصة</p>
          <img src="public/frontend/infixlmstheme/img/banner/global.png"  class="img-fluid pt-3 d-none d-lg-block" />

          <div class="socail_links">


                        @if(saasEnv('ALLOW_FACEBOOK_LOGIN')=='true')

                            <a href="{{ route('social.oauth', 'facebook') }}"
                            class="theme_btn small_btn2 text-center facebookLoginBtn">
                                <i class="fab fa-facebook-f"></i>
                                {{__('frontend.Login with Facebook')}}</a>
                        @endif

                        @if(saasEnv('ALLOW_GOOGLE_LOGIN')=='true')
                            <a href="{{ route('social.oauth', 'google') }}"
                            class="theme_btn small_btn2 text-center googleLoginBtn">
                                <i class="fab fa-google"></i>
                                {{__('frontend.Login with Google')}}</a>
                        @endif
                        </div>
            @if(saasEnv('ALLOW_FACEBOOK_LOGIN')=='true' || saasEnv('ALLOW_GOOGLE_LOGIN')=='true')
                    <p class="login_text">{{__('frontend.Or')}} {{__('frontend.login with Email Address')}}</p>
                @endif

        </div>
        <div class="col-lg-5" style="margin-top: 50px">

            <!-- End OF LAYOUT it is static structure in all Auth code -->

          <div>
            <div class="bg-light rounded-4 pt-5 px-4 pb-3">
              <p class="text-center" style="
                    font-size: 28px;
                    font-family: Bahij;
                    transform: translateY(10px);
                  ">
                تسجيل الدخول
              </p>

              <form action="{{route('login')}}" method="POST" id="loginForm">
              @csrf

                <div class="input pb-3">
                <div class="input-container">
                    <i class="icon"><img src="public/frontend/infixlmstheme/img/banner/email.svg" /></i>
                    <input type="email" value="{{old('email')}}" class="input-field {{ $errors->has('email') ? ' is-invalid' : '' }} "   placeholder="{{__('ادخل البريد الإلكتروني')}}" name="email" aria-label="Username"
                        aria-describedby="basic-addon3">
                  </div>

                  @if($errors->first('email'))
                                <span class="text-danger" role="alert">{{$errors->first('email')}}</span>
                            @endif
                </div>
                <div class="input pb-3">
                         <div class="input-container">
                        <i class="icon">
                            <img src="public/frontend/infixlmstheme/img/banner/padlock.svg" />
                          </i>
                             <input type="password"  name="password" class=" pass input-field"placeholder="{{__('ادخل كلمة السر')}}" aria-label="password"      aria-describedby="basic-addon4">

                            <button class="mdc-icon-button toggle-password" type="button">
                             <i class="bi bi-eye"></i>
                                  </button>
                         </div>
                         @if($errors->first('password'))
                                <span class="text-danger" role="alert">{{$errors->first('password')}}</span>
                            @endif
                        </div>

                        <div class="col-12 mt_20">
                            @if(saasEnv('NOCAPTCHA_FOR_LOGIN')=='true')
                                @if(saasEnv('NOCAPTCHA_IS_INVISIBLE')=="true")
                                    {!! NoCaptcha::display(["data-size"=>"invisible"]) !!}
                                @else
                                    {!! NoCaptcha::display() !!}
                                @endif

                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="text-danger"
                                          role="alert">{{$errors->first('g-recaptcha-response')}}</span>
                                @endif
                            @endif
                        </div>

                        <div class="d-flex justify-content-between know-me">

                        <div class="form-check">
                        <input class="form-check-input pointer" type="checkbox" value="" id="flexCheckDefault" {{ old('remember') ? 'checked' : '' }} value="1"/>
                        <label class="form-check-label pe-2 pointer" for="flexCheckDefault">
                            تذكرني
                            <span class="checkmark mr_15"></span>
                         <!--   <span class="label_name">{{__('common.Remember Me')}}</span>-->
                        </label>
                        </div>

                            <div>
                            <a  style="text-decoration: underline; color: #07487c" href="{{route('SendPasswordResetLink')}}">نسيت كلمة المرور</a>
                            </div>

                        </div>

                        <div class="mt-3 login">
                    @if(saasEnv('NOCAPTCHA_FOR_LOGIN')=='true' && saasEnv('NOCAPTCHA_IS_INVISIBLE')=="true")

                    <button type="submit" class="btn w-100"  data-sitekey="{{saasEnv('NOCAPTCHA_SITEKEY')}}" data-size="invisible"
                    data-callback="onSubmit">
                    class="theme_btn text-center w-100"> <!--{{__('common.Login')}}-->تسجيل لدخول </button>
                    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                    <script>
                        function onSubmit(token) {
                            document.getElementById("loginForm").submit();
                        }
                    </script>
                    @else
                    <button type="submit"
                            class="theme_btn text-center w-100"> <!--{{__('common.Login')}}--> تسجيل الدخول </button>
                    @endif
                    </div>
                    <span><i class="fas fa-spinner fa-spin"></i></span>
                    </button>
                    </div>

              </form>
              </div>

              <div class="mt-3 socialLogin">
                <!-- Add your social login buttons or components here -->
              </div>
              @if(Settings('student_reg')==1 && saasPlanCheck('student')==false)

              <div class="mt-5 pt-4 notExist">
                <p>
                    لا تمتلك حسابا؟
                  <a href="{{route('register')}}" style="text-decoration: underline; color: #07487c">تسجيل جديد</a>
                </p>
              </div>
              @endif
              @if(env('DEMO_MODE'))
                <div class="row mt-4">
                    <div class="col-md-4 mb_10">

                        <a class="theme_btn small_btn2 text-center w-100"
                           href="{{route('auto.login','admin')}}">Admin</a>

                    </div>

                    <div class="col-md-4 mb_10">
                        <a class="theme_btn small_btn2 text-center w-100"
                           href="{{route('auto.login','teacher')}}">Instructor</a>
                    </div>
                    <div class="col-md-4 mb_10">
                        <a class="theme_btn small_btn2 text-center w-100"
                           href="{{route('auto.login','student')}}">Student</a>

                    </div>
                </div>
            @endif
        </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



</body>

</html>
