@extends('backend.master')
@section('mainContent')
    {!! generateBreadcrumb() !!}

    @if($class->host=="Zoom")
        <div id="view_details">
            <div class="col-lg-12">
                <div class="main-title">
                    <h3 class="mb-20">{{__('zoom.Class')}} {{__('zoom.List')}}

                    </h3>


                </div>

                <div class="QA_section QA_section_heading_custom check_box_table">
                    <div class="QA_table ">
                        <!-- table-responsive -->
                        <div class="">
                            <table id="lms_table" class="table Crm_table_active3">
                                <thead>
                                <tr>
                                <tr>
                                    <th>{{__('common.SL')}}</th>
                                    <th>   {{__('zoom.ID')}}</th>
                                    <th>   {{__('zoom.Password')}}</th>
                                    <th>   {{__('zoom.Topic')}}</th>
                                    <th>   {{__('zoom.Date')}}</th>
                                    <th>   {{__('zoom.Time')}}</th>
                                    <th>   {{__('zoom.Duration')}}</th>
                                    <th>   {{__('zoom.Start Join')}}</th>
                                    <th>{{__('zoom.Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($class->zoomMeetings as $key => $meeting )

                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $meeting->meeting_id }}</td>
                                        <td>{{ $meeting->password }}</td>
                                        <td>{{ $meeting->topic }}</td>
                                        <td>{{ $meeting->date_of_meeting }}</td>
                                        <td>{{ $meeting->time_of_meeting }}</td>
                                        <td>{{ MinuteFormat($meeting->meeting_duration) }}</td>
                                        <td>
                                            @if($meeting->currentStatus == 'started')

                                                <a class="primary-btn small fix-gr-bg small   text-white border-0"
                                                   href="{{ route('zoom.meeting.join', $meeting->meeting_id) }}"
                                                   target="_blank">
                                                    @if (Auth::user()->role_id == 1 || Auth::user()->id == $meeting->instructor_id)
                                                        {{__('zoom.Start')}}
                                                    @else
                                                        {{__('zoom.Join')}}
                                                    @endif
                                                </a>

                                            @elseif( $meeting->currentStatus == 'waiting')
                                                <a href="#"
                                                   class="primary-btn small bg-info text-white border-0">Waiting</a>
                                            @else
                                                <a href="#"
                                                   class="primary-btn small bg-warning text-white border-0">Closed</a>
                                            @endif
                                        </td>
                                        <td>

                                            <div class="dropdown CRM_dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenu2" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                    {{ __('common.Select') }}
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                     aria-labelledby="dropdownMenu2">
                                                    {{--                                                    <a class="dropdown-item"--}}
                                                    {{--                                                       href="{{ route('zoom.meetings.show', $meeting->meeting_id) }}">{{__('zoom.View')}}</a>--}}
                                                    @if($meeting->created_by==$user->id)
                                                        {{--                                                        <a class="dropdown-item"--}}
                                                        {{--                                                           href="{{ route('zoom.meetings.edit',$meeting->id )}}">{{__('zoom.Edit')}}</a>--}}

                                                        <a class="dropdown-item" data-toggle="modal"
                                                           data-target="#d{{$meeting->id}}"
                                                           href="#">{{__('zoom.Delete')}}</a>
                                                    @endif

                                                </div>
                                            </div>


                                        </td>
                                    </tr>


                                    <div class="modal fade admin-query" id="d{{$meeting->id}}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{__('zoom.Delete Class')}}</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4>{{__('common.Are you sure to delete ?')}}</h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg"
                                                                data-dismiss="modal">{{__('zoom.Cancel')}}</button>
                                                        <form class=""
                                                              action="{{ route('zoom.meetings.destroy',$meeting->id) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="primary-btn fix-gr-bg"
                                                                    type="submit">{{__('zoom.Delete')}}</button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    @elseif($class->host=="BBB" && isModuleActive('BBB'))
        <div id="view_details">
            <div class="col-lg-12">
                <div class="main-title">
                    <h3 class="mb-20">{{__('bbb.Class')}} {{__('bbb.List')}}

                    </h3>


                </div>

                <div class="QA_section QA_section_heading_custom check_box_table">
                    <div class="QA_table ">
                        <!-- table-responsive -->
                        <div class="">
                            <table id="lms_table" class="table Crm_table_active3">
                                <thead>
                                <tr>
                                <tr>
                                    <th>{{__('common.SL')}}</th>
                                    <th>   {{__('bbb.ID')}}</th>
                                    <th>   {{__('bbb.Topic')}}</th>
                                    <th>   {{__('bbb.Date')}}</th>
                                    <th>   {{__('bbb.Time')}}</th>
                                    <th>   {{__('bbb.Duration')}}</th>
                                    <th>   {{__('bbb.Join as Moderator')}}</th>
                                    <th>   {{__('bbb.Join as Attendee')}}</th>

                                    <th>{{__('bbb.Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($class->bbbMeetings as $key => $meeting )
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $meeting->meeting_id }}</td>
                                        <td>{{ $meeting->topic }}</td>
                                        <td>{{ $meeting->date }}</td>
                                        <td>{{ $meeting->time }}</td>
                                        <td> @if($meeting->duration==0)
                                                Unlimited
                                            @else
                                                {{ MinuteFormat($meeting->duration) }}
                                            @endif

                                        </td>
                                        <td>
                                            <form action="{{route('bbb.meetingStart')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="meetingID"
                                                       value="{{$meeting->meeting_id}}">
                                                <input type="hidden" name="type"
                                                       value="Moderator">
                                                <button type="submit" class="primary-btn small fix-gr-bg">Join
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{route('bbb.meetingStart')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="meetingID"
                                                       value="{{$meeting->meeting_id}}">
                                                <input type="hidden" name="type"
                                                       value="Attendee">
                                                <button type="submit" class="primary-btn small fix-gr-bg">Join
                                                </button>
                                            </form>
                                        </td>

                                        <td>


                                            <div class="dropdown CRM_dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenu2" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                    {{ __('common.Select') }}
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                     aria-labelledby="dropdownMenu2">
                                                    <a class="dropdown-item"
                                                       href="{{ route('bbb.meetings.show', $meeting->id) }}">{{__('bbb.View')}}</a>

                                                    <a class="dropdown-item"
                                                       href="{{ route('bbb.recordList', $meeting->id) }}">{{__('bbb.Record List')}}</a>


                                                    <a class="dropdown-item" data-toggle="modal"
                                                       data-target="#d{{$meeting->id}}"
                                                       href="#">{{__('bbb.Delete')}}</a>

                                                </div>
                                            </div>


                                        </td>
                                    </tr>


                                    <div class="modal fade admin-query" id="d{{$meeting->id}}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{__('bbb.Delete Class')}}</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4>{{__('common.Are you sure to delete ?')}}</h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg"
                                                                data-dismiss="modal">{{__('bbb.Cancel')}}</button>
                                                        <form class=""
                                                              action="{{ route('bbb.meetings.destroy',$meeting->id) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="primary-btn fix-gr-bg"
                                                                    type="submit">{{__('bbb.Delete')}}</button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    @elseif($class->host=="Jitsi" && isModuleActive('Jitsi'))
        <div id="view_details">
            <div class="col-lg-12">
                <div class="main-title">
                    <h3 class="mb-20">{{__('jitsi.Class')}} {{__('jitsi.List')}}

                    </h3>


                </div>

                <div class="QA_section QA_section_heading_custom check_box_table">
                    <div class="QA_table ">
                        <!-- table-responsive -->
                        <div class="">
                            <table id="lms_table" class="table Crm_table_active3">
                                <thead>
                                <tr>
                                <tr>
                                    <th>#</th>
                                    <th>   {{__('jitsi.ID')}}</th>
                                    <th>   {{__('jitsi.Topic')}}</th>
                                    <th>   {{__('jitsi.Date')}}</th>
                                    <th>   {{__('jitsi.Time')}}</th>
                                    <th>   {{__('jitsi.Duration')}}</th>
                                    <th>   {{__('jitsi.Join')}}</th>

                                    <th>{{__('jitsi.Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($class->jitsiMeetings as $key => $meeting )
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $meeting->meeting_id }}</td>
                                        <td>{{ $meeting->topic }}</td>
                                        <td>{{ $meeting->date }}</td>
                                        <td>{{ $meeting->time }}</td>
                                        <td> @if($meeting->duration==0)
                                                Unlimited
                                            @else
                                                {{ MinuteFormat($meeting->duration) }}
                                            @endif
                                        </td>

                                        <td>
                                            <a class="primary-btn small fix-gr-bg text-white" target="_blank"
                                               href="{{ route('jitsi.meetings.show', $meeting->id) }}">{{__('jitsi.Start')}}</a>
                                        </td>
                                        <td>


                                            <div class="dropdown CRM_dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenu2" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                    {{ __('common.Select') }}
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                     aria-labelledby="dropdownMenu2">


                                                    <a class="dropdown-item" data-toggle="modal"
                                                       data-target="#d{{$meeting->id}}"
                                                       href="#">{{__('bbb.Delete')}}</a>

                                                </div>
                                            </div>


                                        </td>
                                    </tr>


                                    <div class="modal fade admin-query" id="d{{$meeting->id}}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{__('jitsi.Delete Class')}}</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4>{{__('common.Are you sure to delete ?')}}</h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg"
                                                                data-dismiss="modal">{{__('jitsi.Cancel')}}</button>
                                                        <form class=""
                                                              action="{{ route('jitsi.meetings.destroy',$meeting->id) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="primary-btn fix-gr-bg"
                                                                    type="submit">{{__('jitsi.Delete')}}</button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    @elseif($class->host=="InAppLiveClass" && isModuleActive('InAppLiveClass'))
        <div id="view_details">
            <div class="col-lg-12">
                <div class="main-title">
                    <h3 class="mb-20">{{__('common.In-App Live Class')}} {{__('common.List')}}

                    </h3>


                </div>

                <div class="QA_section QA_section_heading_custom check_box_table">
                    <div class="QA_table ">
                        <!-- table-responsive -->
                        <div class="">
                            <table id="lms_table" class="table Crm_table_active3">
                                <thead>
                                <tr>
                                <tr>
                                    <th>#</th>
                                    <th>   {{__('jitsi.ID')}}</th>
                                    <th>   {{__('jitsi.Topic')}}</th>
                                    <th>   {{__('jitsi.Date')}}</th>
                                    <th>   {{__('jitsi.Time')}}</th>
                                    <th>   {{__('jitsi.Duration')}}</th>
                                    <th>   {{__('jitsi.Join')}}</th>

                                    <th>{{__('jitsi.Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($class->inAppMeetings as $key => $meeting )
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $meeting->meeting_id }}</td>
                                        <td>{{ $meeting->topic }}</td>
                                        <td>{{ $meeting->date }}</td>
                                        <td>{{ $meeting->time }}</td>
                                        <td> @if($meeting->duration==0)
                                                {{__('common.Unlimited')}}
                                            @else
                                                {{ MinuteFormat($meeting->duration) }}
                                            @endif
                                        </td>

                                        <td>
                                            <a class="primary-btn small fix-gr-bg text-white" target="_blank"
                                               href="{{ route('inappliveclass.meetings.show', $meeting->id) }}">{{__('common.Start')}}</a>
                                        </td>
                                        <td>


                                            <div class="dropdown CRM_dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenu2" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                    {{ __('common.Select') }}
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                     aria-labelledby="dropdownMenu2">


                                                    <a class="dropdown-item" data-toggle="modal"
                                                       data-target="#d{{$meeting->id}}"
                                                       href="#">{{__('common.Delete')}}</a>

                                                </div>
                                            </div>


                                        </td>
                                    </tr>


                                    <div class="modal fade admin-query" id="d{{$meeting->id}}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{__('common.Delete')}} {{__('virtual-class.Class')}}</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4>{{__('common.Are you sure to delete ?')}}</h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg"
                                                                data-dismiss="modal">{{__('common.Cancel')}}</button>
                                                        <form class=""
                                                              action="{{ route('inappliveclass.meetings.destroy',$meeting->id) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="primary-btn fix-gr-bg"
                                                                    type="submit">{{__('common.Delete')}}</button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    @elseif($class->host=="GoogleMeet" && isModuleActive('GoogleMeet'))
        <div id="view_details">
            <div class="col-lg-12">
                <div class="main-title">
                    <h3 class="mb-20">{{__('zoom.Class')}} {{__('zoom.List')}}

                    </h3>


                </div>

                <div class="QA_section QA_section_heading_custom check_box_table">
                    <div class="QA_table ">
                        <!-- table-responsive -->
                        <div class="">
                            <table id="lms_table" class="table Crm_table_active3">
                                <thead>
                                <tr>
                                <tr>
                                    <th> {{__('common.SL')}}</th>
                                    <th>{{__('zoom.ID')}}</th>
                                    <th>{{__('zoom.Date')}}</th>
                                    <th>{{__('zoom.Time')}}</th>
                                    <th>{{__('zoom.Timezone')}}</th>
                                    <th>{{__('zoom.Duration')}}</th>
                                    <th>{{__('zoom.Start Join')}}</th>
                                    <th>{{__('zoom.Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($class->googleMeetMeetings as $key => $meeting )

                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $meeting->meetingId }}</td>
                                        <td>{{ showDate($meeting->start_date_time) }}</td>
                                        <td>{{ showTime($meeting->start_date_time) }}</td>
                                        <td>
                                            @php
                                                $start_response = json_decode($meeting->start_response);
                                            @endphp

                                            {{$start_response->timeZone}}
                                            ( {{\Carbon\Carbon::parse($meeting->start_date_time)->tz()}} )
                                        </td>
                                        <td>{{ MinuteFormat(\Carbon\Carbon::parse($meeting->start_date_time)->diffInMinutes($meeting->end_date_time)) }}</td>

                                        <td>
                                            @if($meeting->currentStatus == 'started')

                                                <a class="primary-btn small fix-gr-bg small   text-white border-0"
                                                   href="{{ $meeting->hangoutLink }}"
                                                   target="_blank">
                                                    @if (Auth::user()->role_id == 1 || Auth::user()->id == $meeting->instructor_id)
                                                        {{__('zoom.Start')}}
                                                    @else
                                                        {{__('zoom.Join')}}
                                                    @endif
                                                </a>

                                            @elseif( $meeting->currentStatus == 'waiting')
                                                <a href="#"
                                                   class="primary-btn small bg-info text-white border-0">Waiting</a>
                                            @else
                                                <a href="#"
                                                   class="primary-btn small bg-warning text-white border-0">Closed</a>
                                            @endif
                                        </td>
                                        <td>

                                            <div class="dropdown CRM_dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenu2" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                    {{ __('common.Select') }}
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                     aria-labelledby="dropdownMenu2">

                                                    <a class="dropdown-item" data-toggle="modal"
                                                       data-target="#d{{$meeting->id}}"
                                                       href="#">{{__('zoom.Delete')}}</a>


                                                </div>
                                            </div>


                                        </td>
                                    </tr>


                                    <div class="modal fade admin-query" id="d{{$meeting->id}}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{__('zoom.Delete Class')}}</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4>{{__('common.Are you sure to delete ?')}}</h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg"
                                                                data-dismiss="modal">{{__('zoom.Cancel')}}</button>
                                                        <form class=""
                                                              action="{{ route('google_meet.meetings.destroy',$meeting->id) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="primary-btn fix-gr-bg"
                                                                    type="submit">{{__('zoom.Delete')}}</button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

    @else
    @endif

    @include('backend.partials.delete_modal')

@endsection

