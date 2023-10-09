@extends('layouts.dashboard.app')

@section('page_title', 'الرئيسية')

@section('heading')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt"></i>الدروس</a></li>
                    <li class="breadcrumb-item active">لوحة القيادة</li>
                </ol>
            </nav>
            <h1 class="m-0">الدروس</h1>
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

        <form enctype="multipart/form-data" method="POST" action="{{route('dashboard.lessons.store', $section->id)}}">
            @csrf
            <input type="hidden" hidden value="{{$type}}">
            
            <div class="row">
                <div class="form-group col-lg-6">
                    <label for="">الدورة</label>
                    <div><span class="badge badge-info">{{ $section->course->name }}</span></div>
                </div>
                <div class="form-group col-lg-6">
                    <label for="">القسم</label>
                    <div><span class="badge badge-danger">{{ $section->name }}</span></div>
                </div>
            </div>
            <div class="form-group">
                <label for="">الإسم</label>
                <input name="name" type="text" class="form-control" placeholder="ادخل الاسم" required>
            </div>
            <div class="form-group">
                <label for="">الوصف</label>
                <textarea name="description" class="form-control" rows="5" placeholder="ادخل الوصف" required></textarea>
            </div>

                <div class="form-group">
                    <label class="form-label">الفيديو</label>
                    <input class="form-control" name="file" type="file" accept="video/*">
                </div>

            <button type="submit" class="btn btn-primary">اضافة</button>
        </form>
    </div>
@endsection