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
    <div class="container mt-4">
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
            <li style="margin-bottom: 15px; width:200px">
                <a class="primary-btn radius_30px mr-10 fix-gr-bg" href="{{ route('partnerships.create') }}">
                    <i class="ti-plus"></i> اضافة شراكة
                </a>
            </li>
        </div>

        @if ($partnerships->isEmpty())
            <div class="row text-center mt-4">
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">لا توجد شراكات!</h4>
                        <p>لا توجد شراكات متاحة حالياً. يرجى التحقق لاحقاً.</p>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                @foreach ($partnerships as $partnership)
                    <div class="col-md-4 mb-4">
                        <div class="card rounded">
                            <!-- Add your card content here -->
                            <div class="card-body">
                                <p class="card-text"><h1 class="text-center ">{{ $partnership->part_title }}</h1></p>
                                <p class="card-text"><h5>معرف التصنيف:</h5>{{ $partnership->category->partcategory_name }}</p>
                                <p class="card-text"><h5>الوصف:</h5>{{ $partnership->part_desc }}</p>
                                <p class="card-text"><h5>المدة:</h5>{{ $partnership->part_duration }}</p>
                                <p class="card-text"><h5>نسبة الشراكة:</h5>{{ $partnership->part_percentage }}</p>
                                <p class="card-text"><h5>الموقع:</h5>{{ $partnership->part_location }}</p>
                                <p class="card-text"><h5>شروط الشراكة:</h5>{{ $partnership->part_rules }}</p>
                                <p class="card-text"><h5>التكلفة:</h5>{{ $partnership->part_cost }}</p>
                                <p class="card-text"><h5> الاضافة بواسطة  :</h5>{{ $partnership->user->name }}</p>

                                <!-- Add edit and delete buttons with appropriate styling -->
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <a style="width: 105px" class="primary-btn radius_30px mr-10 fix-gr-bg"
                                        href="{{ route('partnerships.edit', $partnership->id) }}">
                                        <i class="fas fa-edit update-icon"></i>تعديل
                                    </a>

                                    <form action="{{ route('partnerships.destroy', $partnership->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="primary-btn radius_30px mr-10 fix-gr-bg" type="submit"
                                            class="btn btn-danger">
                                            <i class="fas fa-trash-alt delete-icon"></i>حذف
                                        </button>
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
