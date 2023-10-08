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
        <a href="{{ route('dashboard.lessons.create', $section_id) }}" class="btn btn-success ml-3">اضافة</a>
    </div>
@endsection

@section('content')
    <div class="col-lg-12 card p-4">
        <table class="table mb-0 thead-border-top-0">
            <thead>
                <tr>
                    <th>الإسم</th>
                    <th>الوصف</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="list" >
                @foreach($lessons as $lesson)
                <tr>
                    <td><span class="badge badge-info">{{ $lesson->name }}</span></td>
                    <td><small class="text-muted">{{ $lesson->description }}</small></td>
                    
                    <td style="display:flex;gap:4px">
                        <a href="{{ route('dashboard.lessons.edit', ['section'=>$section_id, 'lesson'=>$lesson->id]) }}" class="text-muted btn btn-info"><i class="material-icons">edit</i></a>
                        <a href="{{ route('dashboard.lessons.destroy', ['section'=>$section_id, 'lesson'=>$lesson->id]) }}" data-id="{{$lesson->id}}" class="item-delete text-muted btn btn-danger"><i class="material-icons">delete</i></a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection