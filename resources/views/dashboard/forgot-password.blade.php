@extends('layouts.dashboard.auth')

@section('page-title', 'اعادة تعيين كلمة السر')

@section('content')
<h4 class="m-0">مرحبا</h4>
<p class="mb-5">اعادة تعيين كلمة السر.</p>

<form action="{{route('dashboard.forgot-password.store')}}" method="post">
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

    <div class="form-group text-center">
        <button class="btn btn-primary mb-5"
                type="submit">ارسال رمز التأكيد</button><br>
        <a href="{{route('dashboard.login.index')}}">تذكرت كلمة السر</a>
    </div>
</form>
@endsection
