@extends('backend.master')
@push('styles')

@endpush


@section('mainContent')

    {!! generateBreadcrumb() !!}

    <section class="admin-visitor-area up_st_admin_visitor">


        <div class="col-12">
            <div class="box_header common_table_header">
            <div class="main-title d-md-flex">
            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">اختبار اقتراح المسار</h3>
            <ul class="d-flex">
                <li>
                    <a class="primary-btn radius_30px mr-10 fix-gr-bg"
                    href="{{ route('suggested-path-test.choices.index', $choice->test->id) }}"></i>{{'رجوع للإختيارات'}}</a>
                </li>
            </ul>
            </div>
            </div>
        </div>


        <div class="card mb-20 text-center">
            <h3 class="p-2">
                <span>السؤال : </span> 
                <span class="text-danger">{{$choice->test->question}}</span>
            </h3>
        </div>

        <div class="white_box mb_30">
            <div class="justify-content-center">

                <form action="{{ route('suggested-path-test.choices.update', request()->id) }}" method="POST">
                    @csrf

                    <div class="col-xl-12">
                        <div class="primary_input mb-25">

                            <label class="primary_input_label" for="">{{'الاختيار'}} <strong
                                class="text-danger">*</strong></label>
                            <input class="primary_input_field" name="choice" placeholder="-"
                               type="text"
                               required
                               value="{{ $choice->title }}" {{$errors->first('choice') ? 'autofocus' : ''}}>

                               <label class="primary_input_label" for="">{{'النقاط'}} <strong
                                class="text-danger">*</strong></label>
                                <input class="primary_input_field" name="points" placeholder="0"
                               type="number"
                               required
                               value="{{ $choice->points }}" {{$errors->first('points') ? 'autofocus' : ''}}>
                          
                        </div>
                    </div>

                    <div class="col-lg-10 text-center pt_15">
                        <div class="d-flex justify-content-center">
                            <button class="primary-btn semi_large2  fix-gr-bg"
                                    id="save_button_parent" type="submit"><i
                                    class="ti-check"></i> {{__('common.Save')}}
                            </button>
                        </div>
                    </div>
                </form>


            </div>


        </div>
    </section>

@endsection


