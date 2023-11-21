@extends(theme('layouts.dashboard_master'))
@section('title'){{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}} | {{__('frontend.My Bundle')}} @endsection
@section('css') @endsection
@section('js') @endsection

@section('mainContent')
 
    @php
$currentLang = app()->getLocale();
@endphp
@if ($currentLang === 'ar')
<div class="text-right">
       <x-my-bundle-page-section/>
</div>
@else
   <x-my-bundle-page-section/>
@endif
@endsection
