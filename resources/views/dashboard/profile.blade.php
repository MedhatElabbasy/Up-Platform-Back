@extends('layouts.dashboard.app')

@section('page_title', 'الرئيسية')

@section('heading')
<div class="page__heading d-flex align-items-end">
    <div class="flex">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">حسابك</li>
            </ol>
        </nav>
        <h1 class="m-0">تحديث ملفك الشخصي</h1>
    </div>
</div>
@endsection

@section('content')
    <div class="container page__container">
        <form method="POST" action="{{route('dashboard.profile.store')}}">
        @csrf
        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-4 card-body">
                    <p><strong class="headings-color">المعلومات الأساسية</strong></p>
                    <p class="text-muted">تحديث معلوماتك الأساسية.</p>
                </div>
                <div class="col-lg-8 card-form__body card-body">
                    <div class="form-group">
                        <label for="fname">الإسم</label>
                        <input id="fname" name="name" type="text" class="form-control" placeholder="اكتب اسمك" value="{{auth()->user()->name}}">
                        @error('name') <small class="invalid-feedback">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-4 card-body">
                    <p><strong class="headings-color">تحديث كلمة السر</strong></p>
                    <p class="text-muted">تغيير كلمة السر.</p>
                </div>
                <div class="col-lg-8 card-form__body card-body">
                    <div class="form-group">
                        <label for="opass">كلمة السر القديمة</label>
                        <input id="opass" name="old_password" type="password" class="form-control" placeholder="اكتب كلمة السر القديمة">
                        @error('old_password') <small class="invalid-feedback">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="npass">كلمة السر الجديدة</label>
                        <input id="npass" name="new_password" type="password" class="form-control" placeholder="اكتب كلمة اسر جديدة">
                        @error('new_password') <small class="invalid-feedback">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="cpass">تأكيد كلمة السر</label>
                        <input id="cpass" name="new_password_confirmation" type="password" class="form-control" placeholder="اعد كتابة كلمة السر الجديدة للتأكيد">
                        @error('new_password_confirmation') <small class="invalid-feedback">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mb-5">
            <button type="submit" class="btn btn-success">تحديث</button>
        </div>
        </form>
    </div>
@endsection