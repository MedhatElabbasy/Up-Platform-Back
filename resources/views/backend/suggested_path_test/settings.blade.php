@extends('backend.master')

@push('styles')
    <!-- tag input css -->
    <link rel="stylesheet" href="{{asset('Modules/Blog/Resources/views/assets/taginput/tagsinput.css')}}"/>
    <!-- select2 design  -->
    <style>
        .select2-container--default .select2-selection--single {
            background-color: #fff;
            width: 100%;
            height: 46px;
            line-height: 46px;
            font-size: 13px;
            padding: 3px 20px;
            padding-left: 20px;
            font-weight: 300;
            border-radius: 30px;
            color: var(--base_color);
            border: 1px solid #ECEEF4
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 46px;
            position: absolute;
            top: 1px;
            right: 20px;
            width: 20px;
            color: var(--text-color);
        }

        .select2-dropdown {
            background-color: white;
            border: 1px solid #ECEEF4;
            border-radius: 4px;
            box-sizing: border-box;
            display: block;
            position: absolute;
            left: -100000px;
            width: 100%;
            width: 100%;
            background: var(--bg_white);
            overflow: auto !important;
            border-radius: 0px 0px 10px 10px;
            margin-top: 1px;
            z-index: 9999 !important;
            border: 0;
            box-shadow: 0px 10px 20px rgb(108 39 255 / 30%);
            z-index: 1051;
            min-width: 200px;
        }

        .select2-search--dropdown .select2-search__field {
            padding: 4px;
            width: 100%;
            box-sizing: border-box;
            box-sizing: border-box;
            background-color: #fff;
            border: 1px solid rgba(130, 139, 178, 0.3) !important;
            border-radius: 3px;
            box-shadow: none;
            color: #333;
            display: inline-block;
            vertical-align: middle;
            padding: 0px 8px;
            width: 100% !important;
            height: 46px;
            line-height: 46px;
            outline: 0 !important;
        }

        .select2-container {
            width: 100% !important;
            min-width: 90px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 40px;
        }
    </style>
    <style>
        .profile-photo {
            border-radius: 50%;
            height: 180px;
            width: 180px;
        }

        .cover-photo {
            height: 180px;
            width: 76%;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .cursor-pointer {
            cursor: pointer !important;
        }

        .badge-custom {
            color: #fff !important;
            background-color: #415094e8 !important;
            padding: 15px 20px;
            font-size: 14px;
            font-weight: bold;
        }

        .custom-hr {
            background-color: rgba(0, 0, 0, .1);
            width: 100%;
            height: 2px;
        }

        .bootstrap-tagsinput {
            min-height: 48px;
            height: fit-content;
        }

        .image_preview {
            height: 120px;
            width: 180px;
        }

        .profile_delete_photo {
            width: 100%;
            height: 90%;
            padding: 20%;
        }


    </style>

@endpush
@section('mainContent')

    <section class="admin-visitor-area up_st_admin_visitor student-details">
        <form action="{{route('suggested-path-test.settings.store')}}" method="post">
            @csrf
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header">
                        <div class="main-title d-flex">
                            <h3 class="mb-0 mr-30">{{ 'اعدادات اقتراح المسار' }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
<div class="white-box">
    <div class="tab-content mt-20">

<div class="row">
<div class="col-12">
<h3>المدة الزمنية</h3>
<hr>

<div class="col-md-12">
    <div class="primary_input mb-25">
        <label class="primary_input_label" for="minutes">المدة الزمنية للاختبار (بالدقائق) <strong class="text-danger">*</strong></label>
        <input class="primary_input_field" name="minutes" id="minutes" type="text" value="{{$settings->minutes}}">
    </div>
</div>

</div>
</div>

<div class="row">
    <div class="col-12">
    <h3>النقاط المطلوبة للمسارات</h3>
    <hr>

    <div class="row">
    <div class="col-md-4 col-lg-4">
        <div class="primary_input mb-25">
            <label class="primary_input_label" for="qualification_path_points">مسار التأهيل <strong class="text-danger">*</strong></label>
            <input class="primary_input_field" name="qualification_path_points" id="qualification_path_points" type="number" value="{{$settings->qualification_path_points}}">
        </div>
    </div>

    <div class="col-md-4 col-lg-4">
        <div class="primary_input mb-25">
            <label class="primary_input_label" for="empowerment_path_points">مسار التمكين <strong class="text-danger">*</strong></label>
            <input class="primary_input_field" name="empowerment_path_points" id="empowerment_path_points" type="number" value="{{$settings->empowerment_path_points}}">
        </div>
    </div>

    <div class="col-md-4 col-lg-4">
        <div class="primary_input mb-25">
            <label class="primary_input_label" for="e_commerce_path_points">مسار التجارة الإلكترونية <strong class="text-danger">*</strong></label>
            <input class="primary_input_field" name="e_commerce_path_points" id="e_commerce_path_points" type="number" value="{{$settings->e_commerce_path_points}}">
        </div>
    </div>
    </div>

    </div>
    </div>


    <div class="row">

        <div class="col-12 text-right">
            <hr class="d-block">
            <button class="primary-btn fix-gr-bg" type="submit"><i class="ti-check"></i> حفظ</button>
        </div>
    </div>

    </div>
</div>
                </div>

            </div>
        </div>
        </form>
    </section>

@endsection
