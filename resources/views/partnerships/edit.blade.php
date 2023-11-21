




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
                <h1> تعديل الشراكة </h1>
                <div class="bc-pages">
                    <a href="#">الرئيسية</a>
                    <a href="#">اطلاق المشاريع</a>
                    <a href="#">تعديل الشراكة</a>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card rounded">
                    <div class="card-header">تعديل شراكة</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('partnerships.update', $partnership->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-8">
                                    <label for="part_title">العنوان</label>
                                    <input type="text" class="form-control" id="part_title" name="part_title"
                                        value="{{ $partnership->part_title }}">
                                </div>

                                <div class="form-group col-4">
                                    <label for="category_id">الفئة</label>
                                    <select class="form-control" id="category_id" name="category_id">
                                        <option value="" disabled>اختر الفئة</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $partnership->category_id ? 'selected' : '' }}>
                                                {{ $category->partcategory_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="part_desc">الوصف</label>
                                <textarea class="form-control" id="part_desc" name="part_desc" rows="4">{{ $partnership->part_desc }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="part_rules">شروط الشراكة</label>
                                <textarea class="form-control" id="part_rules" name="part_rules" rows="4">{{ $partnership->part_rules }}</textarea>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="part_duration">المدة</label>
                                    <input type="text" class="form-control" id="part_duration" name="part_duration"
                                        value="{{ $partnership->part_duration }}">
                                </div>

                                <div class="form-group col-6">
                                    <label for="part_percentage">نسبة الشراكة %</label>

                                    <div class="input-group">
                                        <input type="number" step="0.01" class="form-control" id="part_percentage"
                                            name="part_percentage" value="{{ $partnership->part_percentage }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="part_location">الموقع</label>
                                    <input type="text" class="form-control" id="part_location" name="part_location"
                                        value="{{ $partnership->part_location }}">
                                </div>

                                <div class="form-group col-6">
                                    <label for="part_cost">التكلفة</label>
                                    <input type="text" class="form-control" id="part_cost" name="part_cost"
                                        value="{{ $partnership->part_cost }}">
                                </div>
                            </div>

                            <button type="submit" class="primary-btn radius_30px mr-10 fix-gr-bg">تحديث</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush










