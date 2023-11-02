@extends(theme('layouts.dashboard_master'))
@section('title')
    {{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}} | {{__('frontend.Reward Point')}}
@endsection
@section('css') @endsection
@section('js')


@endsection
@section('mainContent')

    
    
    @php
$currentLang = app()->getLocale();
@endphp
@if ($currentLang === 'ar')
<div class="text-right">
       <x-reward-page-section/>
</div>
@else
    <x-reward-page-section/>
@endif
@endsection
