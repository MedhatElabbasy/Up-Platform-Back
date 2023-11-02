@extends(theme('layouts.dashboard_master'))
@section('title'){{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}} | {{__('payment.Purchase history')}} @endsection
@section('css') @endsection
@section('js') @endsection

@section('mainContent')
  
    @php
$currentLang = app()->getLocale();
@endphp
@if ($currentLang === 'ar')
<div class="text-right">
     <x-notification-setup />
</div>
@else
  <x-notification-setup />
@endif
@endsection
