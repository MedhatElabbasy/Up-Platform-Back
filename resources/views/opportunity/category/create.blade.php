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
                <h1>إنشاء تصنيف جديد للفرصة</h1>
                <div class="bc-pages">
                    <a href="#">الرئيسية</a>
                    <a href="#">اطلاق المشاريع</a>
                    <a href="#">فرصتي  </a>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row" style="width: 100%; margin-bottom: 15px;">
            @if (session()->has('success') || session()->has('error') || session()->has('warning'))
                @foreach (['success', 'error', 'warning'] as $messageType)
                    @if (session()->has($messageType))
                        <div class="alert alert-{{ $messageType }} alert-dismissible fade show w-100" role="alert">
                            <strong>
                                @if ($messageType == 'success')
                                    <i class="fas fa-check-circle"></i> <!-- Success Icon -->
                                @elseif($messageType == 'error')
                                    <i class="fas fa-times-circle"></i> <!-- Error Icon -->
                                @elseif($messageType == 'warning')
                                    <i class="fas fa-exclamation-circle"></i> <!-- Warning Icon -->
                                @endif
                                {{ ucfirst($messageType) }}:
                            </strong> {{ session($messageType) }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card rounded">
                    <div class="card-header">إنشاء تصنيف جديد للفرصة</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('opportunity-categories.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="opp_cat_name">اسم التصنيف</label>
                                <input type="text" class="form-control" id="opp_cat_name" name="opp_cat_name" value="{{ old('opp_cat_name') }}">
                            </div>

                            <div class="form-group">
                                <label for="opp_cat_desc">وصف التصنيف</label>
                                <textarea class="form-control" id="opp_cat_desc" name="opp_cat_desc" rows="4">{{ old('opp_cat_desc') }}</textarea>
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
