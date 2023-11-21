@extends('backend.master')
@push('styles')
    <link rel="stylesheet" href="{{ asset('public/backend/css/daterangepicker.css') }}">
@endpush
@section('mainContent')
    @include('backend.partials.alertMessage')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @include('backend.partials.alertMessage')

    <div class="container">

        <section class="sms-breadcrumb mb-40 white-box">
            <div class="container-fluid">
                <div class="row justify-content-between">
                    <h1>تعديل {{ $category->opp_cat_name }}</h1>
                    <div class="bc-pages">
                        <a href="{{ route('dashboard') }}">الرئيسية</a>
                        <a href="{{ route('opportunity-categories.index') }}">تمويلي</a>
                        <a href="#">التصنيفات</a>
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card rounded">
                        <div class="card-header">تعديل تصنيف التمويل</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('opportunity-categories.update',$category->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="opp_cat_name">اسم التصنيف</label>
                                    <input type="text" class="form-control" id="opp_cat_name"
                                        name="opp_cat_name" value="{{ $category->opp_cat_name }}">
                                </div>

                                <div class="form-group">
                                    <label for="opp_cat_desc">وصف التصنيف</label>
                                    <textarea class="form-control" id="opp_cat_desc" name="opp_cat_desc" rows="4">{{ $category->opp_cat_desc }}</textarea>
                                </div>

                                <button type="submit" class="primary-btn radius_30px mr-10 fix-gr-bg">تعديل</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
@endpush
