@extends('layouts.dashboard.auth')

@section('page-title', 'اعادة تعيين كلمة السر')

@section('content')
<h4 class="m-0">مرحبا</h4>
<p class="mb-5">اعادة تعيين كلمة السر.</p>

<form action="{{route('dashboard.forgot-password.update', ['forgot_password'=>'forgot_password'])}}" method="put">
    @csrf

        <div class="alert alert-info">
            ادخل الرمز الذي تم ارساله لبريدك الإلكتروني.
        </div>

        <div class="form-group">
        <label class="text-label"
               for="code">الرمز:</label>
        <div class="input-group input-group-merge">
            <input id="code"
                   name="code"
                   type="code"
                   required
                   min="6"
                   class="form-control form-control-prepended"
                   placeholder="أدخل الرمز">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fa fa-key"></span>
                </div>
            </div>
        </div>

        @error('code') <span class="text-danger">{{ $message }}</span> @enderror
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

    <div class="form-group text-center">
        <button class="btn btn-primary mb-5"
                type="submit">ارسال رمز التأكيد</button><br>
        <a href="{{route('dashboard.login.index')}}">تذكرت كلمة السر</a>
    </div>
</form>
@endsection
