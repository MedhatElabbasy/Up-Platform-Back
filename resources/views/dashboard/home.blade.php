@extends('layouts.dashboard.app')

@section('page_title', 'الرئيسية')

@section('heading')
<div class="page__heading d-flex align-items-end">
    <div class="flex">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">لوحة القيادة</li>
            </ol>
        </nav>
        <h1 class="m-0">لوحة القيادة</h1>
    </div>
</div>
@endsection

@section('content')
    مرحباً بك في لوحة الإدارة
@endsection