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
                <h1> تعديل العرض </h1>
                <div class="bc-pages">
                    <a href="https://insrvs.com/dashboard">الرئيسية</a>
                    <a href="">اطلاق المشاريع</a>
                    <a href="https://insrvs.com/club/club_events">تمويلي </a>
                </div>
            </div>
        </div>
    </section>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card rounded">
                    <div class="card-header">تعديل عرض {{ $fundingAgency->fund_name }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('funding-agencies.update', $fundingAgency->id) }} "
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">


                                <div class="form-group col-8">
                                    <label for="fund_name"> الاسم</label>
                                    <input type="text" class="form-control" id="fund_name" name="fund_name"
                                        value="{{ $fundingAgency->fund_name }}">
                                </div>
                                <div class="form-group col-4">
                                    <label for="fund_category_id">الفئة</label>
                                    <select class="form-control" id="fund_category_id" name="fund_categories_id">
                                        <option value="" disabled>اختر الفئة</option>
                                        @foreach ($fundCategories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $fundingAgency->fundCategory->id == $category->id ? 'selected' : '' }}>
                                                {{ $category->fund_categories_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>




                            <div class="form-group">
                                <label for="fund_desc"> الوصف</label>
                                <textarea class="form-control" id="fund_desc" name="fund_desc" rows="4">{{ $fundingAgency->fund_desc }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="fund_rules"> الشروط</label>
                                <textarea class="form-control" id="fund_rules" name="fund_rules" rows="4">{{ $fundingAgency->fund_rules }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fund_cost_from"> التمويل من </label>
                                        <input type="number" class="form-control" id="fund_cost_from" name="fund_cost_from"
                                            value="{{ $fundingAgency->fund_cost_from }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fund_cost_to"> التمويل الي </label>
                                        <input type="number" class="form-control" id="fund_cost_to" name="fund_cost_to"
                                            value="{{ $fundingAgency->fund_cost_to }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fund_repay_period"> فترة السداد </label>
                                <input type="text" class="form-control" id="fund_repay_period" name="fund_repay_period"
                                    value="{{ $fundingAgency->fund_repay_period }}">
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="interest_rate"> نسبة الفائدة </label>
                                    <div class="input-group">
                                        <input class="form-control col-6" type="number" id="fund_interset_percentage"
                                            name="fund_interset_percentage" step="0.01"
                                            value="{{ $fundingAgency->fund_interset_percentage }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                                @if ($fundingAgency->fund_logo)
                                    <div class="col-3">
                                        <img src="{{ asset($fundingAgency->fund_logo) }}" alt="صورة الشعار الحالية"
                                            class="mt-2" style="max-width: 100%;">
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="fund_logo">صورة الشعار</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="fund_logo" name="fund_logo">
                                            <label class="custom-file-label" for="fund_logo">اختر صورة</label>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group col-6">
                                        <label for="fund_logo">صورة الشعار</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="fund_logo"
                                                name="fund_logo">
                                            <label class="custom-file-label" for="fund_logo">اختر صورة</label>
                                        </div>
                                    </div>
                                @endif


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
