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
                        <input type="date" name="appointment_date" id="appointment_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="appointment_time">Appointment Time:</label>
                        <input type="time" name="appointment_time" id="appointment_time" class="form-control" required>
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


