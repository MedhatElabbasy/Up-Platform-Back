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

        <div class="row">
            <li style="margin-bottom: 15px; width:200px"><a class="primary-btn radius_30px mr-10 fix-gr-bg"
                    href="{{ route('opportunities.create') }}"><i class="ti-plus"></i> اضافة فرصة </a>
            </li>
        </div>

        @if ($opportunities->isEmpty())
            <div class="row text-center mt-4">
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">لا توجد فرص!</h4>
                        <p>لا توجد فرص متاحة حالياً. يرجى التحقق لاحقاً.</p>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                @foreach ($opportunities as $opportunity)
                    <div class="col-md-4 mb-4">
                        <div class="card rounded">

                            @if ($opportunity->opp_image)
                                <img src="{{ asset($opportunity->opp_image) }}" class="card-img-top" alt="image">
                            @else
                                <img src="{{ asset('public/uploads/funding/images/defult/null.jpeg') }}"
                                    class="card-img-top" alt="default image">
                            @endif

                            <div class="card-body">
                                <h5 class="card-title text-center">
                                    <h1 class='text-center'>{{ $opportunity->opp_name }}</h1>
                                </h5>
                                <p class="card-text">
                                <h5>التصنيف:</h5>{{ $opportunity->category->opp_cat_name }}
                                </p>
                                <p class="card-text"> <span>
                                        <h5> الوصف:</h5>
                                    </span> {{ $opportunity->opp_desc }}</p>
                                <p class="card-text">
                                <h5>شروط الفرصة:</h5> {{ $opportunity->opp_rules }}
                                </p>

                                <p class="card-text">
                                <h5>التكلفة من:</h5> {{ $opportunity->opp_cost_from }} </p>
                                <p class="card-text">
                                <h5>التكلفة إلى:</h5> {{ $opportunity->opp_cost_to }}
                                </p>
                                <p class="card-text">
                                <h5>نسبة حقوق الملكية:</h5>
                                {{ $opportunity->opp_copyrights_percentage }} %
                                </p>
                                <p class="card-text">
                                <h5>نسبة التسويق:</h5>
                                {{ $opportunity->opp_markting_percentage }} %
                                </p>
                                <p class="card-text">
                                <h5>مدة العقد:</h5>
                                {{ $opportunity->opp_contract_duration }}
                                </p>
                                <p class="card-text">
                                <h5>الموقع:</h5> {{ $opportunity->opp_location }}
                                </p>

                                <!-- Add edit and delete buttons with appropriate styling -->
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <a style="width: 105px" class="primary-btn radius_30px mr-10 fix-gr-bg "
                                        href="{{ route('opportunities.edit', $opportunity->id) }}"><i
                                            class=" fas fa-edit update-icon"></i>تعديل</a>

                                    <form action="{{ route('opportunities.destroy', $opportunity->id) }}" method="POST"
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
        @endif
    </div>


@endsection
@push('scripts')
@endpush
