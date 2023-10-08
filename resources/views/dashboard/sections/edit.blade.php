@extends('layouts.dashboard.app')

@section('page_title', 'الرئيسية')

@section('heading')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt"></i>الأقسام</a></li>
                    <li class="breadcrumb-item active">لوحة القيادة</li>
                </ol>
            </nav>
            <h1 class="m-0">الأقسام</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-lg-12 card p-4">

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <form method="POST" action="{{ route('dashboard.sections.update', ['course'=>$section->course_id, 'section'=>$section->id]) }}">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="">الدورة</label>
                <div><span class="badge badge-info">{{ $section->course->name }}</span></div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">الإسم</label>
                <input name="name" type="text" class="form-control" placeholder="ادخل الاسم" value="{{$section->name}}" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">الوصف</label>
                <textarea name="description" class="form-control" rows="5" placeholder="ادخل الوصف" required>{{$section->description}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">تحديث</button>
        </form>
    </div>
@endsection