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
                href="{{ route('suggested-path-test.index') }}"></i>{{'رجوع للأسئلة'}}</a>
            </li>
        </ul>
        </div>
        </div>
        </div>

        <div class="white_box mb_30">
            <div class="justify-content-center">

                <form action="{{ route('suggested-path-test.update', request()->id) }}" method="POST">
                    @csrf

                    <div class="col-xl-12">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label"
                                   for="">{{'السؤال'}} <strong
                                    class="text-danger">*</strong></label>
                            <input class="primary_input_field" name="question" placeholder="-"
                                   required
                                   type="text"
                                   value="{{ $test->question }}" {{$errors->first('question') ? 'autofocus' : ''}}>
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


