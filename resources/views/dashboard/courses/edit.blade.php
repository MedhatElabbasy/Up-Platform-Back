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

        <form method="POST" action="{{ route('dashboard.courses.update', $course->id) }}">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="exampleInputEmail1">الإسم</label>
                <input name="name" type="text" class="form-control" placeholder="ادخل الاسم" value="{{$course->name}}" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">الوصف</label>
                <textarea name="description" class="form-control" rows="5" placeholder="ادخل الوصف" required>{{$course->description}}</textarea>
            </div>
            <div class="form-group">
                <label for="">السعر</label>
                <input name="price" type="number" min="0" class="form-control" placeholder="ادخل السعر" value="{{$course->price}}" required>
            </div>
            <div class="form-group">
                <label for="">القسم</label>
                <select name="category" class="form-control">
                    @foreach($categories as $category)
                    <option @selected($course->category_id == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">تحديث</button>
        </form>
    </div>
@endsection