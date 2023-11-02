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

    <div class="container">
        
        
        
        <section class="sms-breadcrumb mb-40 white-box">
            <div class="container-fluid">
                <div class="row justify-content-between">
                    <h1>Create Event</h1>
                    <div class="bc-pages">
                        <a href="https://insrvs.com/dashboard">Dashboard</a>
                        <a href="">Clubs</a>
                        <a href="https://insrvs.com/club/club_events">Create Event</a>
                    </div>
                </div>
            </div>
        </section>
        
        
        
        
        <form action="{{ route('club_events.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price by <strong>CAP</strong></label>
                <input type="number" class="form-control" id="price" name="price">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
              <div class="mb-3">
                    <label for="rouls" class="form-label">Conditions</label>
                    <textarea class="form-control" id="rouls" name="rouls"></textarea>
                </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location">
            </div>
            <button class="primary-btn radius_30px mr-10 fix-gr-bg" type="submit" >Create</button>
        </form>
    </div>


@endsection
@push('scripts')
@endpush
