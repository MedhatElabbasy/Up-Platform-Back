
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

{{--
    @foreach ($users as $user)
    <h2>id: {{ $user->id }}</h2>
    <h2>User: {{ $user->name }}</h2>
    <h2>phone: {{ $user->phone }}</h2>

    <ul>
        @foreach ($user->clubEvents as $clubEventUser)
            @php
                $clubEvent = $clubEventUser->clubEvent;
            @endphp
            <li>Event: {{ $clubEvent->title }}</li>
            <li>Event Description: {{ $clubEvent->description }}</li>
            <!-- Add more event data as needed -->
        @endforeach
    </ul>
@endforeach --}}
@dd($users)

@endsection
@push('scripts')
@endpush



