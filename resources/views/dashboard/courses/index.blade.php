@extends('layouts.dashboard.app')

@section('page_title', 'الرئيسية')

@section('heading')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt"></i>الدورات</a></li>
                    <li class="breadcrumb-item active">لوحة القيادة</li>
                </ol>
            </nav>
            <h1 class="m-0">الدورات</h1>
        </div>
        <a href="{{ route('dashboard.courses.create') }}" class="btn btn-success ml-3">اضافة</a>
    </div>
@endsection

@section('content')
    <div class="col-lg-12 card p-4">
        <table class="table mb-0 thead-border-top-0">
            <thead>
                <tr>
                    <th>الإسم</th>
                    <th>الوصف</th>
                    <th>السعر</th>
                    <th>القسم</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="list" >

                @foreach($courses as $course)
                <tr>
                    <td><span class="badge badge-info">{{ $course->name }}</span></td>
                    <td><small class="text-muted">{{ $course->description }}</small></td>
                    <td><small>{{ $course->price }}</small></td>
                    <td><small class="badge badge-danger">{{ $course->category->name }}</small></td>
                    
                    <td style="display:flex;gap:4px">
                        <a href="{{ route('dashboard.sections.index', $course->id) }}" class="text-muted btn btn-success"><span>الأقسام والمحتوي</span></a>
                        <a href="{{ route('dashboard.courses.edit', $course->id) }}" class="text-muted btn btn-info"><i class="material-icons">edit</i></a>
                        <a href="{{ route('dashboard.courses.destroy', $course->id) }}" data-id="{{$course->id}}" class="item-delete text-muted btn btn-danger"><i class="material-icons">delete</i></a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection