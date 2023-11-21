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


    <div class="table-container"
        style="background-color: #ffffff;
border-radius: 10px;
padding: 20px;
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">


        <li style="margin-bottom: 15px; width:200px"><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="{{ route('fund-categories.create') }}"><i
                    class="ti-plus"></i> اضافة تصيف </a>
        </li>




        <div class="table-responsive">
            <table class="table" style="width: 100%;
    margin-bottom: 0;
    color: #333333;">
                <thead>
                    <tr>
                        <th style="  background-color: #f8f9fa;
border-top: none;
font-weight: bold;">#
                        </th>
                        <th style="  background-color: #f8f9fa;
border-top: none;
font-weight: bold;">الاسم
                        </th>
                        <th style="  background-color: #f8f9fa;
                        border-top: none;
                        font-weight: bold;">عدد التمويلات
                                                </th>

                        <th
                            style="  background-color: #f8f9fa;
                border-top: none;
                font-weight: bold;">
                           تاريخ الانشاء
                        </th>
                        <th style="  background-color: #f8f9fa;
border-top: none;
font-weight: bold;">العمليات
                        </th>


                    </tr>
                </thead>
                <tbody>
                    @php
                        $d=0;
                    @endphp
                    @foreach ($fundCategories as $i)
                        <tr>
                            <td style="border-top: none;">{{ ++$d }}</td>
                            <td style="border-top: none;">{{ $i->fund_categories_name }}</td>
                            <td style="border-top: none;">{{ $i->fundingAgencies()->count() }}</td>
                            <td style="border-top: none;">{{ $i->created_at }}</td>
                            <td style="border-top: none;">


                                <a  style="width: 105px" class="primary-btn radius_30px mr-10 fix-gr-bg "
                                    href="{{ route('fund-categories.edit', $i->id) }}"><i
                                        class=" fas fa-edit update-icon"></i>تعديل</a>



                                        @if($i->fundingAgencies->isEmpty())
                                        <form action="{{ route('fund-categories.destroy', $i->id) }}" method="POST"
                                            style="display: inline">
                                            @csrf
                                            @method('DELETE')

                                            <button style="transform: translate(-117px,-30px)" class="primary-btn radius_30px mr-10 fix-gr-bg" type="submit"
                                                style="transform: translateY(-11px)" class="btn btn-danger"><i
                                                    class="fas fa-trash-alt delete-icon"></i>حذف</button>

                                        </form>
                                    @else
                                        {{-- <button class="btn btn-danger" disabled>حذف</button> --}}
                                        {{-- <button style="transform: translate(-117px,-30px)" class="primary-btn radius_30px mr-10 fix-gr-bg " disabled type="submit"
                                                style="transform: translateY(-11px)" class="btn btn-danger"><i
                                                    class="fas fa-trash-alt delete-icon"></i>حذف</button> --}}
                                        <span class="text-danger">لا يمكن حذف هذا التصنيف لان لديه تمويلات</span>
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
