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

    <div class="table-container" style="background-color: #ffffff; border-radius: 10px; padding: 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">

        <li style="margin-bottom: 15px; width:200px">
            <a class="primary-btn radius_30px mr-10 fix-gr-bg" href="{{ route('opportunity-categories.create') }}">
                <i class="ti-plus"></i> إضافة تصنيف
            </a>
        </li>

        <div class="table-responsive">
            <table class="table" style="width: 100%; margin-bottom: 0; color: #333333;">
                <thead>
                    <tr>
                        <th style="background-color: #f8f9fa; border-top: none; font-weight: bold;">#</th>
                        <th style="background-color: #f8f9fa; border-top: none; font-weight: bold;">الاسم</th>
                        <th style="background-color: #f8f9fa; border-top: none; font-weight: bold;">الوصف</th>
                        <th style="background-color: #f8f9fa; border-top: none; font-weight: bold;">عدد الفرص</th>
                        <th style="background-color: #f8f9fa; border-top: none; font-weight: bold;">تاريخ الإنشاء</th>
                        <th style="background-color: #f8f9fa; border-top: none; font-weight: bold;">العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @php $d=0; @endphp
                    @foreach ($categories as $category)
                        <tr>
                            <td style="border-top: none;">{{ ++$d }}</td>
                            <td style="border-top: none;">{{ $category->opp_cat_name }}</td>
                            <td style="border-top: none;">{{ $category->opp_cat_desc }}</td>
                            <td style="border-top: none;">{{ $category->opportunities()->count() }}</td>
                            <td style="border-top: none;">{{ $category->created_at }}</td>
                            <td style="border-top: none;">
                                <a style="width: 105px" class="primary-btn radius_30px mr-10 fix-gr-bg" href="{{ route('opportunity-categories.edit', $category->id) }}">
                                    <i class="fas fa-edit update-icon"></i> تعديل
                                </a>

                                @if($category->opportunities->isEmpty())
                                    <form action="{{ route('opportunity-categories.destroy', $category->id) }}" method="POST" style="display: inline">
                                        @csrf
                                        @method('DELETE')

                                        <button style="transform: translate(-117px,-30px)" class="primary-btn radius_30px mr-10 fix-gr-bg" type="submit">
                                            <i class="fas fa-trash-alt delete-icon"></i> حذف
                                        </button>
                                    </form>
                                @else
                                    <span class="text-danger">لا يمكن حذف هذا التصنيف لأن لديه تمويلات</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
