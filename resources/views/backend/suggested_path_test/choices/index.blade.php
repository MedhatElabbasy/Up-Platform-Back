@extends('backend.master')
@push('styles')
    <link rel="stylesheet" href="{{asset('public/backend/css/student_list.css')}}"/>
@endpush

@section('table')
    @php
        $table_name='users';
    @endphp
    {{$table_name}}
@stop
@section('mainContent')

    {!! generateBreadcrumb() !!}
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">

            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">اختبار اقتراح المسار</h3>
                            @if (permissionCheck('instructor.store'))
                            <ul class="d-flex">
                                <li>
                                    @if(isModuleActive('Appointment'))
                                        <a class="primary-btn radius_30px mr-10 fix-gr-bg"
                                           id="add_model_btn"
                                           href="{{ route('appointment.instructor.create') }}"><i
                                                class="ti-plus"></i>{{'اضافة اختيار'}}</a>
                                    @else
                                        <a class="primary-btn radius_30px mr-10 fix-gr-bg" data-toggle="modal"
                                           id="add_model_btn"
                                           data-target="#add_model" href="#"><i
                                                class="ti-plus"></i>{{'اضافة اختيار'}}</a>
                                    @endif

                                </li>
                            </ul>
                        @endif
                        </div>

                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">

                            <!-- table-responsive -->
                            <div class="">

                                <div class="card mb-20 text-center">
                                    <h3 class="p-2">
                                        <span>السؤال : </span> 
                                        <span class="text-danger">{{$question->question}}</span>
                                    </h3>
                                </div>
                                    
                                <table id="lms_table" class="table Crm_table_active3">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{__('common.SL')}}</th>
                                        <th scope="col">{{'الاختيار'}}</th>
                                        <th scope="col">{{'النقاط'}}</th>
                                        <th scope="col">{{__('common.Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($question->answers as $answer)
                                        <tr>
                                            <td scope="col"><strong>{{ $loop->iteration }}</strong></td>
                                            <td scope="col">{{ $answer->title }}</td>
                                            <td scope="col">{{ $answer->points }}</td>
                                            <td>
                                                <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenu2{{$question->id}}" data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false">
                                                        {{__('common.Action')}}
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                         aria-labelledby="dropdownMenu2{{$question->id}}">

                                                    <a href="{{route('suggested-path-test.choices.update', $answer->id)}}"
                                                        class="dropdown-item"
                                                    >تعديل</a>

                                                        <button data-toggle="modal"
                                                                data-target="#deleteModel"
                                                                onclick="document.getElementById('ModelDeleteId').value='{{$answer->id}}'"
                                                                class="dropdown-item"
                                                                type="button">{{__('common.Delete')}}</button>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add Modal Item_Details -->
                <!-- new product -->
                <div class="modal fade admin-query" id="add_model">
                    <div class="modal-dialog modal_1000px modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">اضف اختيار</h4>
                                <button type="button" class="close " data-dismiss="modal">
                                    <i class="ti-close "></i>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form action="{{route('suggested-path-test.choices.store', $question->id)}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="">{{'الاختيار'}} <strong
                                                        class="text-danger">*</strong></label>
                                                <input class="primary_input_field" name="choice" placeholder="-"
                                                       type="text"
                                                       required
                                                       value="{{ old('choice') }}" {{$errors->first('choice') ? 'autofocus' : ''}}>

                                                       <label class="primary_input_label" for="">{{'النقاط'}} <strong
                                                        class="text-danger">*</strong></label>
                                                        <input class="primary_input_field" name="points" placeholder="0"
                                                       type="number"
                                                       required
                                                       value="{{ old('points')??0 }}" {{$errors->first('points') ? 'autofocus' : ''}}>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 text-center pt_15">
                                        <div class="d-flex justify-content-center">
                                            <button class="primary-btn semi_large2  fix-gr-bg" id="save_button_parent"
                                                    type="submit"><i
                                                    class="ti-check"></i> {{__('common.Save')}}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade admin-query" id="deleteModel">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                                <form action="{{route('suggested-path-test.choices.delete')}}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h4 class="modal-title">{{'حذف الإختيار'}}</h4>
                                    <button type="button" class="close" data-dismiss="modal"><i
                                            class="ti-close "></i></button>
                                </div>

                                <div class="modal-body">
                                    <div class="text-center">

                                        <h4>{{__('common.Are you sure to delete ?')}}</h4>
                                    </div>
                                    <input type="hidden" name="id" value="" id="ModelDeleteId">

                                    <div class="mt-40 d-flex justify-content-between">
                                        <button type="button" class="primary-btn tr-bg"
                                                data-dismiss="modal">{{__('common.Cancel')}}</button>
                                        <button class="primary-btn fix-gr-bg"
                                                type="submit">{{__('common.Delete')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
