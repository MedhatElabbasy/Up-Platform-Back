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


        <li style="margin-bottom: 15px; width:200px"><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="{{ route('club_events.create') }}"><i
                    class="ti-plus"></i> ااضافة حدث</a>
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
font-weight: bold;">العنوان
                        </th>
                        <th
                            style="  background-color: #f8f9fa;
                        border-top: none;
                        font-weight: bold;">
                            السعر
                        </th>
                        <th style="  background-color: #f8f9fa;
border-top: none;
font-weight: bold;">
                            الوصف</th>
                        <th style="  background-color: #f8f9fa;
border-top: none;
font-weight: bold;">
                            الشروط</th>
                        <th
                            style="  background-color: #f8f9fa;
                    border-top: none;
                    font-weight: bold;">
                            الموقع
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
                    @foreach ($clubEvents as $i)
                        <tr>
                            <td style="border-top: none;">{{ ++$d }}</td>
                            <td style="border-top: none;">{{ $i->title }}</td>
                            <td style="border-top: none;">{{ $i->price }} <span><strong>/cap</strong></span> </td>
                            <td style="border-top: none;">{{ $i->description }}</td>
                            <td style="border-top: none;">{{ $i->rouls }}</td>
                            <td style="border-top: none;">{{ $i->location }}</td>
                            <td style="border-top: none;">{{ $i->created_at }}</td>
                            <td style="border-top: none;">


                                <a  style="width: 105px" class="primary-btn radius_30px mr-10 fix-gr-bg "
                                    href="{{ route('club_events.edit', $i->id) }}"><i
                                        class=" fas fa-edit update-icon"></i>تعديل</a>


                                <form action="{{ route('club_events.destroy', $i->id) }}" method="POST"
                                    style="display: inline">
                                    @csrf
                                    @method('DELETE')

                                    <button style="transform: translate(-117px,-30px)" class="primary-btn radius_30px mr-10 fix-gr-bg" type="submit"
                                        style="transform: translateY(-11px)" class="btn btn-danger"><i
                                            class="fas fa-trash-alt delete-icon"></i>حذف</button>

                                </form>
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
