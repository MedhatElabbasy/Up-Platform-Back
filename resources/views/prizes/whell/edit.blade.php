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

    <form action="{{ route('whell.update_prize', $wheelPrize->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="points">Points</label>
            <input type="text" name="points" id="points" class="form-control" value="{{ $wheelPrize->points }}"
                required>
        </div>
        <div class="form-group">
            <label for="probability">Probability</label>
            <input type="text" name="probability" id="probability" class="form-control"
                value="{{ $wheelPrize->probability }}" required>
        </div>
        <button type="submit" class="primary-btn radius_30px mr-10 fix-gr-bg">Update</button>
    </form>


@endsection
@push('scripts')
@endpush
