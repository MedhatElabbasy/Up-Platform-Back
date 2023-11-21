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


        <section class="sms-breadcrumb mb-40 white-box">
            <div class="container-fluid">
                <div class="row justify-content-between">
                    <h1>تعديل {{ $fundCategory->fund_categories_name }}</h1>
                    <div class="bc-pages">
                        <a href="https://insrvs.com/dashboard">الرئيسية</a>
                        <a href="">تمويلي</a>
                        <a href="https://insrvs.com/club/club_events">التصنيفات</a>
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
                            <form method="POST" action="{{ route('fund-categories.update', $fundCategory->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="fund_categories_name">اسم التصنيف</label>
                                    <input type="text" class="form-control" id="fund_categories_name"
                                        name="fund_categories_name" value="{{ $fundCategory->fund_categories_name }}">
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
