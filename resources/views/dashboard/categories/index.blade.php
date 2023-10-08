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
        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-success ml-3">اضافة</a>
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

                @foreach($categories as $category)
                <tr>
                    <td><span class="badge badge-info">{{ $category->name }}</span></td>
                    <td><small class="text-muted">{{ $category->description }}</small></td>
                    
                    <td style="display:flex;gap:4px">
                        <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="text-muted btn btn-info"><i class="material-icons">edit</i></a>
                        <a href="{{ route('dashboard.categories.destroy', $category->id) }}" data-id="{{$category->id}}" class="item-delete text-muted btn btn-danger"><i class="material-icons">delete</i></a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection