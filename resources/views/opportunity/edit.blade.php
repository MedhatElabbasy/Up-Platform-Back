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

    {!! generateBreadcrumb() !!}

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1> تعديل الفرصة </h1>
                <div class="bc-pages">
                    <a href="{{ route('dashboard') }}">الرئيسية</a>
                    <a href="{{ route('opportunities.index') }}">اطلاق المشاريع</a>
                    <a href="{{ route('opportunities.edit', $opportunity->id) }}">تعديل فرصة</a>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card rounded">
                    <div class="card-header">تعديل عرض {{ $opportunity->opp_name }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('opportunities.update', $opportunity->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-8">
                                    <label for="opp_name"> الاسم</label>
                                    <input type="text" class="form-control" id="opp_name" name="opp_name"
                                        value="{{ $opportunity->opp_name }}">
                                </div>

                                <div class="form-group col-4">
                                    <label for="category_id">الفئة</label>
                                    <select class="form-control" id="category_id" name="category_id">
                                        <option value="" disabled>اختر الفئة</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $opportunity->category->id == $category->id ? 'selected' : '' }}>
                                                {{ $category->opp_cat_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="opp_desc"> الوصف</label>
                                <textarea class="form-control" id="opp_desc" name="opp_desc" rows="4">{{ $opportunity->opp_desc }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="opp_rules"> الشروط</label>
                                <textarea class="form-control" id="opp_rules" name="opp_rules" rows="4">{{ $opportunity->opp_rules }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="opp_cost_from"> التمويل من </label>
                                        <input type="number" class="form-control" id="opp_cost_from" name="opp_cost_from"
                                            value="{{ $opportunity->opp_cost_from }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="opp_cost_to"> التمويل الي </label>
                                        <input type="number" class="form-control" id="opp_cost_to" name="opp_cost_to"
                                            value="{{ $opportunity->opp_cost_to }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="opp_contract_duration"> مدة العقد </label>
                                <input type="text" class="form-control" id="opp_contract_duration"
                                    name="opp_contract_duration" value="{{ $opportunity->opp_contract_duration }}">
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="opp_copyrights_percentage"> نسبة حقوق الملكية </label>
                                    <input class="form-control" type="number" id="opp_copyrights_percentage"
                                        name="opp_copyrights_percentage" step="0.01"
                                        value="{{ $opportunity->opp_copyrights_percentage }}">
                                </div>
                                <div class="form-group col-6">
                                    <label for="opp_markting_percentage"> نسبة التسويق </label>
                                    <input class="form-control" type="number" id="opp_markting_percentage"
                                        name="opp_markting_percentage" step="0.01"
                                        value="{{ $opportunity->opp_markting_percentage }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="opp_location"> الموقع </label>
                                <input type="text" class="form-control" id="opp_location" name="opp_location"
                                    value="{{ $opportunity->opp_location }}">
                            </div>

                            <div class="row">
                                @if ($opportunity->opp_image)
                                    <div class="col-3">
                                        <img src="{{ asset($opportunity->opp_image) }}" alt="صورة الشعار الحالية"
                                            class="mt-2" style="max-width: 100%;">
                                    </div>
                                @endif
                                <div class="form-group col-{{ $opportunity->opp_image ? '9' : '12' }}">
                                    <label for="opp_image">صورة الشعار</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="opp_image" name="opp_image">
                                        <label class="custom-file-label" for="opp_image">اختر صورة</label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="primary-btn radius_30px mr-10 fix-gr-bg">تعديل</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
@endpush
