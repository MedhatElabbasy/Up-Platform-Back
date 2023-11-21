@extends('backend.master')
@push('styles')
    <link rel="stylesheet" href="{{asset('public/backend/css/student_list.css')}}"/>
@endpush

@section('table')
    @php
        $table_name='users';
    @endphp
    {{$table_name}}
@stop
@section('mainContent')

    {!! generateBreadcrumb() !!}
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">

            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('common.Consultant Appointment')}} {{__('common.List')}}</h3>
                            

                        </div>

                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <table id="lms_table" class="table Crm_table_active3">
                                    <thead>
                                    <tr data-id="id">
                                        <th scope="col">{{__('common.SL')}}</th>
                                        <th scope="col">{{__('common.Consultant Name')}}</th>
                                        {{-- <th scope="col">{{__('common.Email')}}</th> --}}
                                        
                                        <th scope="col">{{__('common.User')}}</th>
                                        <th scope="col">{{__('common.User phone')}}</th>
                                       
                                        <th scope="col">{{__('common.Created at')}}</th>
                                        <th scope="col">{{__('common.Appointment Date')}}</th>
                                        <th scope="col">{{__('common.Appointment Time')}}</th>
                                        <th scope="col">{{__('common.Status')}}</th>
                                        <th scope="col">{{__('common.Message')}}</th>
                                        <th scope="col">{{__('common.Action')}}</th>
                                       
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="zoomModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Zoom Link</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="zoomForm">
                            @csrf
                            <div class="form-group">
                                <label for="zoom_link">Zoom Link:</label>
                                <input type="text" class="form-control" id="zoomLink" name="zoom_link" required>
                            </div>
                            <div class="form-group">
                                <label for="zoom_password">Zoom Password:</label>
                                <input type="text" class="form-control" id="zoomPassword" name="zoom_password" required>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="saveZoom()">Save Zoom Link</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection

@push('scripts')
    
    @php
        $url = route('getAllconsultantOPP');
    @endphp

    <script>
         
        
        let table = $('#lms_table').DataTable({
            bLengthChange: true,
            "lengthChange": true,
            "lengthMenu": [[10, 25, 50, 100, 100000], [10, 25, 50, 100, "All"]],
            "bDestroy": true,
            processing: true,
            serverSide: true,
            stateSave: true,
            order: [[0, "desc"]],
            "ajax": $.fn.dataTable.pipeline({
                url: '{!! $url !!}',
                pages: 5 // number of pages to cache
            }),
            columns: [
                { 
        data: 'DT_RowIndex', 
            name: 'id',
            render: function (data, type, row) {
                // Render the ID and set it as data-id for the row
                return '<span data-id="' + row.id + '">' + data + '</span>';
            }
    },
       
        { data: 'receiver_name', name: 'receiver_name', orderable: true },
        // { data: 'receiver_email', name: 'receiver_email', orderable: true },
        
        { data: 'user_name', name: 'user_name', orderable: true }, // Assuming 'user' is a relationship, use 'user_name'
        { data: 'user_email', name: 'user_email', orderable: true },
        
        { data: 'created_at', name: 'created_at', orderable: true },
        { data: 'appointment_date', name: 'appointment_date', orderable: true },
        { data: 'appointment_time', name: 'appointment_time', orderable: true },
        
        
        {
            data: 'status',
            name: 'status',
            orderable: true,
            render: function (data, type, row) {
                // Customize the display based on the 'status' value
                return data === 1 ? '<span class="badge badge-success">Confirmed</span>' : '<span class="badge badge-warning">Pending</span>';

            }
        },
        { data: 'message', name: 'message', orderable: true },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false,
            render: function (data, type, row) {
                // Render the action column, e.g., a button to trigger the pop-up
                return '<button class="btn btn-sm btn-primary" onclick="openZoomPopup(' + row.id + ')">Send Zoom Link</button>';
            }
        },

            ],
            language: {
                emptyTable: "{{ __("common.No data available in the table") }}",
                search: "<i class='ti-search'></i>",
                searchPlaceholder: '{{ __("common.Quick Search") }}',
                paginate: {
                    next: "<i class='ti-arrow-right'></i>",
                    previous: "<i class='ti-arrow-left'></i>"
                }
            },
            dom: 'Blfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '<i class="far fa-copy"></i>',
                    title: $("#logo_title").val(),
                    titleAttr: '{{ __("common.Copy") }}',
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="far fa-file-excel"></i>',
                    titleAttr: '{{ __("common.Excel") }}',
                    title: $("#logo_title").val(),
                    margin: [10, 10, 10, 0],
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    },

                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="far fa-file-alt"></i>',
                    titleAttr: '{{ __("common.CSV") }}',
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="far fa-file-pdf"></i>',
                    title: $("#logo_title").val(),
                    titleAttr: '{{ __("common.PDF") }}',
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    },
                    orientation: 'landscape',
                    pageSize: 'A4',
                    margin: [0, 0, 0, 12],
                    alignment: 'center',
                    header: true,
                    customize: function (doc) {
                        doc.content[1].table.widths =
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    }

                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    titleAttr: '{{ __("common.Print") }}',
                    title: $("#logo_title").val(),
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fa fa-columns"></i>',
                    postfixButtons: ['colvisRestore']
                }
            ],
            columnDefs: [{
                visible: false
            },
                {responsivePriority: 1, targets: 0},
                {responsivePriority: 1, targets: 2},
                {responsivePriority: 2, targets: -2},
            ],
            responsive: true,
        });
        </script>
        <script>
    function openZoomPopup(id) {
        // Pass the requestId to the function and open the modal
        $('#zoomModal').modal('show');
        // Set the requestId in the data-request-id attribute of the modal
        $('#zoomModal').attr('data-request-id', id);
    }

    function saveZoom() {
        // Get data from the form
        var zoomLink = $('#zoomLink').val();
        var zoomPassword = $('#zoomPassword').val();
        // Get the requestId from the data-request-id attribute of the modal
        var requestId = $('#zoomModal').attr('data-request-id');

        // Send data to the server using AJAX
        $.ajax({
            type: 'POST',
            url: '{{ route("submitZoomLink") }}', // Update the URL to match your route
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                requestId: requestId,
                zoomLink: zoomLink,
                zoomPassword: zoomPassword
            },
            success: function (data) {
                // Handle success, e.g., close the modal
                $('#zoomModal').modal('hide');
            },
            error: function (error) {
                alert('saving Zoom link.');
                // Handle error, e.g., show an alert
                location.reload();
            }
        });
    }

    </script>
    
    

{{-- <script src="{{asset('public/backend/js/consultant_list.js')}}"></script> --}}
@endpush


