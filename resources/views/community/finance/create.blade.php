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




    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card rounded">
                    <div class="card-header">إنشاء عرض جديد</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('funding-agencies.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-8">
                                    <label for="fund_name"> الاسم</label>
                                    <input type="text" class="form-control" id="fund_name" name="fund_name"
                                        value="{{ old('fund_name') }}">
                                </div>

                                <div class="form-group col-4">
                                    <label for="fund_category_id">الفئة</label>
                                    <select class="form-control" id="fund_category_id" name="fund_categories_id">
                                        <option value="" disabled selected>اختر الفئة</option>
                                        @foreach ($fundCategories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('fund_category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->fund_categories_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>




                            <div class="form-group">
                                <label for="fund_desc"> الوصف</label>
                                <textarea class="form-control" id="fund_desc" name="fund_desc" rows="4">{{ old('fund_desc') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="fund_rules"> الشروط</label>
                                <textarea class="form-control" id="fund_rules" name="fund_rules" rows="4">{{ old('fund_rules') }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fund_cost_from"> التمويل من </label>
                                        <input type="number" class="form-control" id="fund_cost_from" name="fund_cost_from"
                                            value="{{ old('fund_cost_from') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fund_cost_to"> التمويل الي </label>
                                        <input type="number" class="form-control" id="fund_cost_to" name="fund_cost_to"
                                            value="{{ old('fund_cost_to') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fund_repay_period"> فترة السداد </label>
                                <input type="text" class="form-control" id="fund_repay_period" name="fund_repay_period"
                                    value="{{ old('fund_repay_period') }}">
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="interest_rate"> نسبة الفائدة </label>
                                    <div class="input-group">
                                        <input class="form-control col-6" type="number" id="fund_interset_percentage"
                                            name="fund_interset_percentage" step="0.01"
                                            value="{{ old('fund_interset_percentage') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group col-6">
                                    <label for="fund_logo">صورة الشعار</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="fund_logo" name="fund_logo">
                                        <label class="custom-file-label" for="fund_logo">اختر صورة</label>
                                    </div>
                                </div>

                            </div>


                            <button type="submit" class="primary-btn radius_30px mr-10 fix-gr-bg">إنشاء</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@push('scripts')
@endpush
