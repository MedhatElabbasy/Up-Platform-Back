@extends(theme('layouts.dashboard_master'))
@section('title')
    {{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}} | {{__('frontendmanage.My Profile')}}
@endsection
@section('css')
    <link href="{{asset('public/frontend/infixlmstheme/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('public/frontend/infixlmstheme/css/checkout.css')}}" rel="stylesheet"/>
    <link href="{{asset('public/frontend/infixlmstheme/css/myProfile.css')}}" rel="stylesheet"/>
@endsection
@section('js')
    <script src="{{asset('public/frontend/infixlmstheme/js/select2.min.js')}}"></script>
    <script src="{{ asset('public/frontend/infixlmstheme/js/my_profile.js') }}"></script>

    <script src="{{asset('public/frontend/infixlmstheme/js/city.js')}}"></script>


    <script src="{{asset('public/backend/js/summernote-bs4.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.primary_textarea4 ').summernote({
                codeviewFilter: true,
                codeviewIframeFilter: true,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen']],
                ],
                placeholder: 'Write here',
                tabsize: 2,
                height: 188,
                tooltip: true
            });
        });

        $('#two_step_verification').on('change', function () {
            let test = $(this).val();
            if (test == 0) {
                $('#expired_time').addClass('d-none');
            } else if (test == 1) {
                $('#expired_time').removeClass('d-none');
            } else if (test == 2) {
                $('#expired_time').addClass('d-none');
            }
        });

        $('.select2').select2();

    </script>
@endsection

@section('mainContent')

    @php
$currentLang = app()->getLocale();
@endphp
@if ($currentLang === 'ar')
<div class="text-right">
        <x-my-profile-page-section/>
</div>
@else
    <x-my-profile-page-section/>
@endif



@endsection
