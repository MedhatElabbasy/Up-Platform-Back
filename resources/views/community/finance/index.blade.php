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
        <div class="row" style="width: 100%; margin-bottom: 15px;">
            @if (session()->has('success') || session()->has('error') || session()->has('warning'))
                @foreach (['success', 'error', 'warning'] as $messageType)
                    @if (session()->has($messageType))
                        <div class="alert alert-{{ $messageType }} alert-dismissible fade show w-100" role="alert">
                            <strong rong>
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
        <div class="row">
            <li style="margin-bottom: 15px; width:200px"><a class="primary-btn radius_30px mr-10 fix-gr-bg"
                    href="{{ route('funding-agencies.create') }}"><i class="ti-plus"></i> اضافة تمويل </a>
            </li>
        </div>
        @if ($fundingAgencies->isEmpty())
            <div class="row text-center mt-4">
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">لا يوجد تمويلات!</h4>
                        <p>لا يوجد تمويلات متاحة حالياً. يرجى التحقق لاحقاً.</p>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            @foreach ($fundingAgencies as $opportunity)
                <div class="col-md-4 mb-4">
                    <div class="card rounded">

                        @if ($opportunity->fund_logo)
                        <img src="{{ asset($opportunity->fund_logo) }}" class="card-img-top" alt="image">
                        @else
                            <img src="{{ asset('public/uploads/funding/images/defult/null.jpeg') }}" class="card-img-top"
                                alt="default image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-center">
                                <h1 class='text-center'>{{ $opportunity->fund_name }}</h1>
                            </h5>
                            <p class="card-text">
                            <h5>
                                التصنيف:</h5>{{ $opportunity->fundCategory->fund_categories_name }}</p>
                            <p class="card-text"> <span>
                                    <h3> الوصف:</h3>
                                </span> {{ $opportunity->fund_desc }}</p>
                            <p class="card-text">
                            <h5>شروط التمويل:</h5> {{ $opportunity->fund_rules }}</p>

                            <p class="card-text">
                            <h5>التمويل من:</h5> {{ $opportunity->fund_cost_from }} </p>
                            <p class="card-text">
                            <h5>التمويل إلى:</h5> {{ $opportunity->fund_cost_to }}</p>
                            <p class="card-text">
                            <h5>نسبة الفائدة:</h5>
                            {{ $opportunity->fund_interset_percentage }} %</p>
                            <p class="card-text">
                            <h5>فترة السداد:</h5> {{ $opportunity->fund_repay_period }}</p>


                            <!-- Add edit and delete buttons with appropriate styling -->
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <a style="width: 105px" class="primary-btn radius_30px mr-10 fix-gr-bg "
                                    href="{{ route('funding-agencies.edit', $opportunity->id) }}"><i
                                        class=" fas fa-edit update-icon"></i>تعديل</a>

                                <form action="{{ route('funding-agencies.destroy', $opportunity->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="primary-btn radius_30px mr-10 fix-gr-bg" type="submit"
                                        class="btn btn-danger"><i class="fas fa-trash-alt delete-icon"></i>حذف</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


@endsection
@push('scripts')
@endpush
