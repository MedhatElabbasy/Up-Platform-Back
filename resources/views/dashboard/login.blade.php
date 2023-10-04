@extends('layouts.dashboard.auth')

@section('page-title', 'تسجيل الدخول')

@section('content')
<h4 class="m-0">مرحبا بعودتك</h4>
<p class="mb-5">سجل الدخول للوصول.</p>

<form action="{{route('dashboard.login.store')}}" method="post">
    @csrf

    @if ($errors->any())
        <div class="alert alert-danger">
            {{$errors->first('failed')}}
        </div>
    @endif

    <div class="form-group">
        <label class="text-label"
               for="email">البريد الالكتروني:</label>
        <div class="input-group input-group-merge">
            <input id="email"
                   name="email"
                   type="email"
                   required
                   class="form-control form-control-prepended"
                   placeholder="ادخل بريدك الإلكتروني">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="far fa-envelope"></span>
                </div>
            </div>
        </div>

        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="text-label"
               for="password">كلمة السر:</label>
        <div class="input-group input-group-merge">
            <input id="password"
                   name="password"
                   type="password"
                   required
                   min="6"
                   class="form-control form-control-prepended"
                   placeholder="ادخل كلمة السر">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fa fa-key"></span>
                </div>
            </div>
        </div>

        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <!--
    <div class="form-group mb-5">
        <div class="custom-control custom-checkbox">
            <input type="checkbox"
                   class="custom-control-input"
                   checked=""
                   id="remember">
            <label class="custom-control-label"
                   for="remember">Remember me</label>
        </div>
    </div>
    -->
    <div class="form-group text-center">
        <button class="btn btn-primary mb-5"
                type="submit">تسجيل الدخول</button><br>
        <a href="{{route('dashboard.forgot-password.index')}}">نسيت كلمة السر</a>
    </div>
</form>
@endsection
