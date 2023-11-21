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
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('common.Consultant messages')}} </h3>
                            

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
                                        <th scope="col">{{__('common.Message')}}</th>
                                        <th scope="col">{{__('common.Created at')}}</th>
                                        <th scope="col">{{__('common.Replied at')}}</th>
                                        <th scope="col">{{__('common.Status')}}</th>
                                       
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

        <!-- Add this modal markup to your HTML -->
        <div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="replyModalLabel">Reply to Message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Reply to user message</p>
                        <textarea id="replyTextarea" name="replied_message" class="form-control" rows="4" placeholder="Your Reply"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="confirmAndSubmitReply()">Submit Reply</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@push('scripts')
    
    @php
        $url = route('getAllconsultantMSG');
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
        { data: 'message', name: 'message', orderable: true },
        { data: 'created_at', name: 'created_at', orderable: true },
        {
            data: 'replied_at',
            name: 'replied_at',
            orderable: true,
            render: function (data, type, row) {
                // Check if 'replied_at' is null
                if (row.replied_at === null) {
                    return '<button class="btn btn-primary" onclick="showReplyModal(' + row.id + ')">Reply</button>';
                } else {
                    // Customize the display based on the 'replied_at' value
                    return data;
                }
            }
        },

        {
            data: 'status',
            name: 'status',
            orderable: true,
            render: function (data, type, row) {
                // Customize the display based on the 'status' value
                return data === 1 ? '<span class="badge badge-success">Replied</span>' : '<span class="badge badge-warning">Pending</span>';

            }
        }

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
        function replyFunction(id) {
            // Your logic for handling the reply function
            console.log('Reply button clicked for ID:', id);

            // Open a modal or perform other actions
            // For example, you can call your existing showReplyModal function
            showReplyModal(id);
        }

        function showReplyModal(id) {
            
                

                // Set data-id attribute for the modal
                $('#replyModal').data('id', id);

                // Optionally, you can set the reply content if needed
                let reply = ''; // Replace with your logic
                $('#replyTextarea').val(reply);

                // Show the modal
                $('#replyModal').modal('show');
           
        }

    </script>
    <script>
        function showReplyModal(id) {
            // Set data-id attribute for the modal
            $('#replyModal').data('id', id);

            // Optionally, you can set the reply content if needed
            let reply = ''; // Replace with your logic
            $('#replyTextarea').val(reply);

            // Show the modal
            $('#replyModal').modal('show');
        }

        function confirmAndSubmitReply() {
            // Use SweetAlert or another library for a better confirmation dialog
            if (confirm('Are you sure you want to submit this reply?')) {
                submitReply();
                // Refresh the page
        window.location.reload();
            }
        }

        function submitReply() {
    let id = $('#replyModal').data('id');
    let reply = $('#replyTextarea').val();

    // Add CSRF token to the data
    let data = {
        id: id,
        reply: reply,
        _token: '{{ csrf_token() }}',
    };

    $.ajax({
        url: '{{ route("submitReplyMSG") }}',
        method: 'POST',
        data: data,
        success: function (response) {
        console.log('Response:', response);
        // Handle success
        $('#replyModal').modal('hide');
        table.ajax.reload();
        $('#replyTextarea').val('');
        
    },

       
    });
}

    </script>


{{-- <script src="{{asset('public/backend/js/consultant_list.js')}}"></script> --}}
@endpush


