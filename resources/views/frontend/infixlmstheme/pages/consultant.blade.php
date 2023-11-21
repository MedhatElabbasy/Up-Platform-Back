@extends(theme('layouts.master'))
@section('title'){{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}} |   {{$consultant->name}} @endsection
@section('css')
    <style>
        .course_less_students {
            margin-bottom: 30px;
        }
    </style>
@endsection
@section('js')

    <script>

        var SITEURL = "{{route('consultantDetails',[$consultant->id,Str::slug($consultant->name,'-')])}}";
        var page = 1;
        load_more(page);
        $(window).scroll(function () { //detect page scroll
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 400) {
                page++;
                load_more(page);
            }


        });

        function load_more(page) {
            $.ajax({
                url: SITEURL + "?page=" + page,
                type: "get",
                datatype: "html",
                beforeSend: function () {
                    $('.ajax-loading').show();
                }
            })
                .done(function (data) {
                    if (data.length == 0) {

                        //notify user if nothing to load
                        $('.ajax-loading').html("");
                        return;
                    }
                    $('.ajax-loading').hide(); //hide loading animation once data is received
                    $("#results").append(data); //append data into #results element


                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('No response from server');
                });

        }
        


    
    
</script>

<script>
    $(document).ready(function () {
        $('#appointment_date').change(function () {
            var selectedDate = $(this).val();

            // Make an AJAX request to fetch available appointment times
            $.ajax({
                url: '{{ route("get-appointment-times", ["id" => $consultant->id]) }}',
                type: 'GET',
                data: { date: selectedDate },
                success: function (response) {
                    // Clear previous options
                    $('#appointment_time').empty();

                    // Populate the appointment times
                    $.each(response.times, function (index, time) {
                        $('#appointment_time').append('<option value="' + time + '">' + time + '</option>');
                    });
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    });
</script>
@endsection

@section('mainContent')

<x-breadcrumb :banner="$frontendContent->instructor_page_banner" :title="$frontendContent->instructor_page_title"
    :subTitle="$frontendContent->instructor_page_sub_title"/>


    <div class="instractos_details_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="instractos_profile mb_30">
                        <div class="thumb">
                            <img src="{{getInstructorImage($consultant->image)}}" alt="#">
                        </div>
                        <div class="instractor_meta">
                            <h4>{{$consultant->name}}</h4>
                            <span>{{$consultant->headline}}</span>
                            <div class="social_media">
                               
                                    <button type="button" class="theme_btn d-block text-center height_50 mb_10" data-toggle="modal" data-target="#Bio">
                                    View Resume
                                </button>
    
                            </div>
                        </div>
                    </div>
                </div>
                @if ($consultantPackageDetails->isNotEmpty())
                @foreach ($consultantPackageDetails as $package)
                <div class="col-lg-8 offset-xl-1">
                    <div class="instractos_main_details mb_30">
                        <div class="course__details_title">
                            <div class="single__details">
                                <div class="details_content">
                                    <h3>Text consultation</h3>
                                    <p> {{ $package->text_consultation_description}}</p>
                                    <div class="sidebar__widget mb_30">
                                        <div class="sidebar__title">
                                            <h3>
                                                {{ $package->text_consultation_price}} SAR
                                            </h3>
                                        </div>
                                        @auth
                                        <button type="button" class="theme_btn d-block text-center height_50 mb_10" data-toggle="modal" data-target="#adviceModal">Ask for advice</button>
                                        @endauth
                                        @guest
                                        <a href="{{ route('login') }}" class="theme_btn d-block text-center height_50 mb_10 text-info">You must log in first to ask for advice</a>
                                        @endguest
                                        <p class="font_14 f_w_500 text-center mb_30"></p>
                                                    
                                                                                                                                                                                                                    
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="single__details">
                                <div class="details_content">
                                    <h3>Online consultation</h3>
                                    <p>{{ $package->online_consultation_description}}</p>
                                    <div class="sidebar__widget mb_30">
                                        <div class="sidebar__title">
                                            <h3>
                                                {{ $package->online_consultation_price}} SAR
                                            </h3>
                                        </div>
                                         @auth
                                        <button type="button" class="theme_btn d-block text-center height_50 mb_10" data-toggle="modal" data-target="#requestModalopp">Ask for advice</button>
                                        @endauth
                                        @guest
                                        <a href="{{ route('login') }}" class="theme_btn d-block text-center height_50 mb_10 text-info">You must log in first to ask for advice</a>
                                        @endguest
                                        <p class="font_14 f_w_500 text-center mb_30"></p>
                                        
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                                <p>No consultant packages found for this consultant. come and check again later!</p>
                            @endif
                        </div>
                       
                    </div>
                </div>
            </div>
    
        </div>
    </div>
    <!-- ask for advice modal -->
    <div class="modal fade" id="adviceModal" tabindex="-1" role="dialog" aria-labelledby="adviceModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adviceModalLabel">Ask for Advice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{  route('consultant.ask-for-advice', ['id' => $consultant->id])  }}">
                        @csrf
                        <div class="form-group">
                            <label for="message">Your Message:</label>
                            <textarea name="message" id="message" class="form-control" rows="10" placeholder="Enter your message here!" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ask for appointment modal -->
    <div class="modal fade" id="requestModalopp" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="requestModalLabel">Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{  route('consultant.ask-for-appointment', ['id' => $consultant->id])  }}" id="requestForm">
                        @csrf
                        <div class="form-group">
                            <label for="message">Your Message:</label>
                            <textarea name="message" id="message" class="form-control" rows="4" placeholder="Enter your message here!" required></textarea>
                        </div>
    
                        <!-- Additional fields for appointment request -->
                        <div class="form-group">
                            <label for="appointment_date">Appointment Date:</label>
                            <select name="appointment_date" id="appointment_date" class="form-control" required>
                                @foreach($availableDates as $date)
                                    <option value="{{ $date }}">{{ $date }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="appointment_time">Appointment Time:</label>
                            <select name="appointment_time" id="appointment_time" class="form-control" required>
                                <!-- Appointment times will be dynamically populated here -->
                            </select>
                        </div>
                    
    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- View Resume Modal -->
    <div class="modal fade" id="Bio" tabindex="-1" role="dialog" aria-labelledby="bioModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bioModalLabel">View Resume</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Display the resume content here -->
                    <p>Consultant name: {{ $consultant->name }} </p>
                 
                    @if ($consultant->education->isNotEmpty())
                    <br>
                    <h3>Education</h3>
                    <ul>
                        @foreach ($consultant->education as $edu)
                            <li>
                                <strong>Degree:</strong> {{ $edu->degree }}<br>
                                <strong>Institution:</strong> {{ $edu->institution }}<br>
                                <strong>Start Date:</strong> {{ $edu->start_date }}<br>
                                <strong>End Date:</strong> {{ $edu->end_date }}
                            </li>
                        @endforeach
                    </ul>
                @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    
    


    {{-- <div class="course_by_author">
        <div class="container">
            <div class="theme_border"></div>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section__title text-center mb_80">
                        <h3>{{__('frontend.More Courses by Author')}}</h3>
                    </div>
                </div>
            </div>
            <div class="row" id="results">

            </div>
        </div>
    </div> --}}
   

@endsection


