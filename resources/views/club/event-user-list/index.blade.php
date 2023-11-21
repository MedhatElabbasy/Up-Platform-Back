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


    <div class="table-container"
        style="background-color: #ffffff;
border-radius: 10px;
padding: 20px;
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">

        {{--
        <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="{{ route('club_events.create') }}"><i
                    class="ti-plus"></i>New Event</a>
        </li> --}}




        <div class="table-responsive">
            <table class="table" style="width: 100%;
    margin-bottom: 0;
    color: #333333;">
                <thead>
                    <tr>
                        <th style="  background-color: #f8f9fa;
border-top: none;
font-weight: bold;">#
                        </th>
                        <th style="  background-color: #f8f9fa;
border-top: none;
font-weight: bold;">Student Name
                        </th>
                        <th
                            style="  background-color: #f8f9fa;
                        border-top: none;
                        font-weight: bold;">
                            Phone
                        </th>
                        <th style="  background-color: #f8f9fa;
border-top: none;
font-weight: bold;">
                            Event Title</th>
                        <th style="  background-color: #f8f9fa;
border-top: none;
font-weight: bold;">
                            Event Location</th>
                        <th
                            style="  background-color: #f8f9fa;
                    border-top: none;
                    font-weight: bold;">
                            End At
                        </th>

                        <th style="  background-color: #f8f9fa;
border-top: none;
font-weight: bold;">action
                        </th>


                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($users as $user)
                        <tr>
                            <td style="border-top: none;">{{ ++$i }}</td>
                            <td style="border-top: none;">{{ $user->name }}</td>
                            <td style="border-top: none;">{{ $user->phone }}</td>
                            @foreach ($user->clubEvents as $clubEvent)
                                <td style="border-top: none;">{{ $clubEvent->title }}</td>
                                <td style="border-top: none;">{{ $clubEvent->location }}</td>
                                <td> {{ $clubEvent->created_at->addMonth(1)->format('Y-m-d') }}</td>
                            @endforeach
                            <td style="border-top: none;">

                                <form
                                    action="{{ route('events.users.destroy', ['eventId' => $clubEvent->id, 'userId' => $user->id]) }}"
                                    method="POST" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="primary-btn radius_30px mr-10 fix-gr-bg" type="submit"
                                        style="transform: translateY(-11px)" class="btn btn-danger">
                                        <i class="fas fa-trash-alt delete-icon"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

@endsection
@push('scripts')
@endpush
