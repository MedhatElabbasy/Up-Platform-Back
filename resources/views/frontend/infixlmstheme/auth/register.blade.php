@extends(theme('auth.layouts.app'))
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Fav icon -->
  <link rel="icon" type="image/png" href="public/frontend/infixlmstheme/img/banner/fav-icon.png">
  <title>{{ Settings('site_title') . " - تسجيل حساب" }}</title>
</head>

<div class="main" style="direction: rtl; font-family: Bahij">
      <div class="container min-vh-100">
        <div class="row min-vh-75 align-items-center">
          <div class="col-lg-6 offset-lg-1">
          <span class="py-2 px-4 rounded-pill bg-light" style="color: #07487c">{{__('مرحبا بك')}}</span>
          <h1 class="mt-2 mb-2" >{{ 'في منصة ' . Settings('site_title')}}</h1>
          <p class="text-title">سجل دخولك حتي تتمكن من استخدم المنصة</p>
          <img src="public/frontend/infixlmstheme/img/banner/global.png" alt="auth image" class="img-fluid pt-3 d-none d-lg-block" />

          </div>
          <div class="col-lg-5" style="margin-top: 50px">
            <!-- End OF LAYOUT it is static structure in all Auth code -->

            <div class="px-3">
              <div class="bg-light rounded-4 pt-5 px-4 pb-3">
                <p class="text-center pb-2">تسجيل جديد </p>


                <form action="{{route('register')}}" method="POST" id="regForm">
                    @csrf
                    <div class="row">

                        @if(isModuleActive('Organization'))
                            <div class="col-12 mt_20">
                                <label>{{trans('organization.account_type')}}</label>
                                <ul class="quiz_select d-flex">
                                    <li>
                                        <label
                                            class="primary_bulet_checkbox d-flex">
                                            <input checked class="quizAns"
                                                   name="account_type"
                                                   type="radio"
                                                   value="3">

                                            <span
                                                class="checkmark mr_10"></span>
                                            <span
                                                class="label_name">{{__('common.Student')}} </span>
                                        </label>
                                    </li>

                                    <li class="ml-3">
                                        <label
                                            class="primary_bulet_checkbox d-flex">
                                            <input class="quizAns"
                                                   name="account_type"
                                                   type="radio"
                                                   value="5">

                                            <span
                                                class="checkmark mr_10"></span>
                                            <span
                                                class="label_name">{{__('organization.Organization')}} </span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        @endif

                        @if($custom_field->show_name)
                        <div class="input pb-3">
                    <div class="input-container">
                      <i class="icon"><img src="public/frontend/infixlmstheme/img/banner/user.svg" /></i>
                      <input
                        formControlName="name"
                        type="text"
                        class="input-field"
                        placeholder=" ادخل الاسم  {{ $custom_field->required_name ? '' : ''}}"
                                           {{ $custom_field->required_name ? 'required' : ''}} aria-label="Username"
                                           name="name" value="{{old('name')}}">

                    </div>
                    <span class="text-danger" role="alert">{{$errors->first('name')}}</span>
                  </div>
                  @endif
                  <div class="input pb-3">
                    <div class="input-container">
                      <i class="icon"><img src="public/frontend/infixlmstheme/img/banner/email.svg" /></i>
                      <input
                        formControlName="email"
                        type="email"
                        class="input-field"
                        placeholder="{{__('ادخل البريد الإلكتروني')}} " aria-label="email" name="email"
                                       value="{{old('email')}}">
                    </div>
                    <span class="text-danger" role="alert">{{$errors->first('email')}}</span>
                  </div>
                  @if($custom_field->show_phone)
                  <div class="input pb-3">
                    <div class="input-container">
                      <i class="icon"><img src="public/frontend/infixlmstheme/img/banner/phone.svg" /></i>
                      <input
                        formControlName="phone"
                        type="text"
                        class="input-field"
                        placeholder="{{__('رقم الجوال')}} {{ $custom_field->required_phone ? '*' : ''}}"
                                           {{ $custom_field->required_phone ? 'required' : ''}}
                                           aria-label="phone" name="phone" value="{{old('phone')}}">
                    </div>
                    <span class="text-danger" role="alert">{{$errors->first('phone')}}</span>
                  </div>
                  @endif

                  <div class="input pb-3">
                    <div class="input-container">
                      <i class="icon">
                        <img src="public/frontend/infixlmstheme/img/banner/padlock.svg" />
                      </i>
                      <input
                        type="password"
                        class=" pass input-field password-input"
                        placeholder="{{__('كلمة المرور')}} *"
                        aria-label="password" name="password">
                      <button
                        class="mdc-icon-button toggle-password"
                        type="button"
                        data-target="password-input"

                      >
                        <i class="bi bi-eye"></i>
                      </button>
                    </div>
                    <span class="text-danger" role="alert">{{$errors->first('password')}}</span>
                  </div>
                  <div class="input pb-3">
                    <div class="input-container">
                      <i class="icon"
                        ><img src="public/frontend/infixlmstheme/img/banner/padlock.svg"
                      /></i>
                      <input
                        type="password"
                        class="pass  input-field confirm-input"
                        placeholder="{{__('إعادة كلمة المرور')}} *"
                                       name="password_confirmation"
                                       aria-label="password_confirmation">
                      <button
                        class="mdc-icon-button toggle-password"
                        type="button"
                        data-target="confirm-input"
                      >
                        <i class="bi bi-eye"></i>
                      </button>
                    </div>
                    <span class="text-danger" role="alert">{{$errors->first('password_confirmation')}}</span>
                  </div>

                        @if($custom_field->show_dob)
                            <div class="col-12 mt_20">
                                <div class="input-group custom_group_field">
                                    <label for="dob">{{__('common.Date of Birth')}} : </label>
                                    <input id="dob" type="text" class="form-control pl-0 datepicker w-100" width="300"
                                           placeholder="{{__('common.Date of Birth')}} {{ $custom_field->required_dob ? '*' : ''}}"
                                           {{ $custom_field->required_dob ? 'required' : ''}} aria-label="Username"
                                           name="dob" value="{{ old('dob') }}">
                                </div>
                                <span class="text-danger" role="alert">{{$errors->first('name')}}</span>
                            </div>
                        @endif


                        @if($custom_field->show_company)
                            <div class="col-12 mt_20">
                                <div class="input-group custom_group_field">
                                    <input type="text" class="form-control pl-0"
                                           placeholder="{{__('common.Enter Company')}} {{ $custom_field->required_company ? '*' : ''}}"
                                           {{ $custom_field->required_company ? 'required' : ''}} aria-label="email"
                                           name="company" value="{{old('company')}}">
                                </div>
                                <span class="text-danger" role="alert">{{$errors->first('company')}}</span>
                            </div>
                        @endif

                        @if($custom_field->show_identification_number)
                            <div class="col-12 mt_20">
                                <div class="input-group custom_group_field">
                                    <input type="text" class="form-control pl-0"
                                           placeholder="{{__('common.Enter Identification Number')}} {{ $custom_field->required_identification_number ? '*' : ''}}"
                                           {{ $custom_field->required_identification_number ? 'required' : ''}}
                                           aria-label="email" name="identification_number"
                                           value="{{old('identification_number')}}">
                                </div>
                                <span class="text-danger"
                                      role="alert">{{$errors->first('identification_number')}}</span>
                            </div>
                        @endif

                        @if($custom_field->show_job_title)
                            <div class="col-12 mt_20">
                                <div class="input-group custom_group_field">
                                    <input type="text" class="form-control pl-0"
                                           placeholder="{{__('common.Enter Job Title')}} {{ $custom_field->required_job_title ? '*' : ''}}"
                                           {{ $custom_field->required_job_title ? 'required' : ''}} aria-label="email"
                                           name="job_title" value="{{old('job_title')}}">
                                </div>
                                <span class="text-danger" role="alert">{{$errors->first('job_title')}}</span>
                            </div>
                        @endif

                        @if($custom_field->show_gender)
                            <div class="col-xl-12">
                                <div class="short_select mt-3">
                                    <div class="row">
                                        <div class="col-xl-5">
                                            <h5 class="mr_10 font_16 f_w_500 mb-0">{{ __('common.choose_gender') }} {{ $custom_field->required_gender ? '*' : '' }}</h5>
                                        </div>
                                        <div class="col-xl-7">
                                            <select class="small_select w-100"
                                                    name="gender" {{ $custom_field->required_gender ? 'selected' : '' }}>
                                                <option value="" data-display="Choose">{{__('common.Choose')}}</option>
                                                <option value="male">{{__('common.Male')}}</option>
                                                <option value="female">{{__('common.Female')}}</option>
                                                <option value="other">{{__('common.Other')}}</option>
                                            </select>

                                        </div>
                                    </div>
                                    <span class="text-danger" role="alert">{{$errors->first('gender')}}</span>

                                </div>
                            </div>
                        @endif

                        @if($custom_field->show_student_type)
                            <div class="col-xl-12">
                                <div class="short_select mt-3">
                                    <div class="row">
                                        <div class="col-xl-5">
                                            <h5 class="mr_10 font_16 f_w_500 mb-0">{{ __('common.choose_student_type') }} {{ $custom_field->required_student_type ? '*' : '' }}</h5>
                                        </div>
                                        <div class="col-xl-7">
                                            <select class="small_select w-100"
                                                    name="student_type" {{ $custom_field->required_student_type ? 'selected' : '' }}>
                                                <option value="personal">{{__('common.Personal')}}</option>
                                                <option value="corporate">{{__('common.Corporate')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <span class="text-danger" role="alert">{{$errors->first('student_type')}}</span>

                                </div>
                            </div>
                        @endif



                        <div class="col-12 mt_20">
                            @if(saasEnv('NOCAPTCHA_FOR_REG')=='true')
                                @if(saasEnv('NOCAPTCHA_IS_INVISIBLE')=="true")
                                    {!! NoCaptcha::display(["data-size"=>"invisible"]) !!}
                                @else
                                    {!! NoCaptcha::display() !!}
                                @endif

                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="text-danger"
                                          role="alert">{{$errors->first('g-recaptcha-response')}}</span>s
                                @endif
                            @endif
                        </div>
                        <div class="mt-3 login">
                        @if(saasEnv('NOCAPTCHA_FOR_REG')=='true' && saasEnv('NOCAPTCHA_IS_INVISIBLE')=="true")
                    <button type="submit" class="btn w-100"
                                        data-sitekey="{{saasEnv('NOCAPTCHA_SITEKEY')}}"
                                        >
                      <span style="font-size: 16px"> {{__('تسجيل الدخول ')}} </span>
                      <span *><i class="fas fa-spinner fa-spin"></i></span>
                    </button>
                    @else
                    <button type="submit" class="btn w-100"
                                        id="submitBtn">
                                    <!--{{__('common.Register')}}-->
                                    إنشاء حساب
                                </button>

                            @endif

                  </div>

                    </div>
                </form>
                <div class="d-flex justify-content-center know-me mt-4">
                  <div>
                    <div class="form-check">
                      <input
                        class="form-check-input pointer"
                        type="checkbox"
                        value=""
                        id="flexCheckDefault"
                        required
                      />
                      <label
                        class="form-check-label pe-2 pointer"
                        for="flexCheckDefault"
                      >
                        اوافق على الشروط والأحكام
                      </label>
                    </div>
                  </div>
                </div>
            </div>

        </div>
        </div>
          </div>
        </div>
      </div>
        <!-- @include(theme('auth.login_wrapper_right'))
     -->


@endsection
