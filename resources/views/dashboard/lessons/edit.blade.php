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

        <form enctype="multipart/form-data" method="POST" action="{{ route('dashboard.lessons.update', ['section'=>$section->id, 'lesson'=>$lesson->id]) }}">
            @csrf
            @method("PUT")

            <div class="container card p-4">
            <div class="row align-items-center justify-content-center">
                <div class="form-group">
                    <div><span class="badge badge-info">{{ ' الدورة: ' . $section->course->name }}</span></div>
                </div>
                <div class="form-group">
                    <div><span class="badge badge-danger">{{ ' القسم: ' . $section->name }}</span></div>
                </div>
            </div>

            <div class="form-group d-flex align-items-center justify-content-center">
                <video
                id="my-video"
                class="video-js vjs-big-play-centered vjs-theme-sea"
                controls
                preload="auto"
                width="500"
                poster=""
                data-setup='{}'
                >
                <source src="{{ url('app/videos/'.$lesson->content) }}" type="application/x-mpegURL">
                </video>
            </div>
            </div>

            <div class="form-group">
                <label for="">الإسم</label>
                <input name="name" type="text" class="form-control" placeholder="ادخل الاسم" value="{{$lesson->name}}" required>
            </div>
            <div class="form-group">
                <label for="">الوصف</label>
                <textarea name="description" class="form-control" rows="5" placeholder="ادخل الوصف" required>{{$lesson->description}}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">تحديث</button>
        </form>
    </div>
@endsection