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
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('quiz.Consultant')}} {{__('common.List')}}</h3>
                            <ul class="d-flex">
                                <li>
                                    <a class="primary-btn radius_30px mr-10 fix-gr-bg" data-toggle="modal"
                                       id="add_consultant_btn" data-target="#add_consultantav" href="#">
                                       <i class="ti-plus"></i>{{__('common.Add Consultant Availability')}}
                                    </a>
                                </li>
                            </ul>

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
                                    <tr>
                                        <th scope="col">{{__('common.SL')}}</th>
                                        <th scope="col">{{__('common.Consultant')}}</th>
                                        <th scope="col">{{__('common.Available Date')}}</th>
                                        <th scope="col">{{__('common.Start time')}}</th>
                                        <th scope="col">{{__('common.End time')}}</th>
                                        <th scope="col">{{__('common.Status')}}</th>
                                        <th scope="col">{{__('common.Created at')}}</th>
                                       
                                        
                                     
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add Modal Item_Details -->
                <!-- new product -->
                <div class="modal fade admin-query" id="add_consultantav">
                    <div class="modal-dialog modal_1000px modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">{{__('common.Add New Availability')}}</h4>
                                <button type="button" class="close " data-dismiss="modal">
                                    <i class="ti-close "></i>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form action="{{route('consultantsav.store')}}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label for="date">Date:</label>
                                                <input type="date" name="date" id="date" class="form-control" required min="{{ now()->format('Y-m-d') }}">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="primary_input mb-35">
                                                <label for="start_time">Start Time:</label>
                                                <input type="time" name="start_time" id="start_time" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="primary_input mb-35">
                                                <label for="end_time">End Time:</label>
                                                <input type="time" name="end_time" id="end_time" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    
                                    
                                    <div class="col-lg-12 text-center pt_15">
                                        <div class="d-flex justify-content-center">
                                            <button class="primary-btn semi_large2  fix-gr-bg" id="save_button_parent"
                                                    type="submit"><i
                                                    class="ti-check"></i> {{__('common.Save')}} 
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    @if ($errors->any())
        <script>
            @if(Session::has('type'))
            @if(Session::get('type')=="store")
            $('#add_consultantav').modal('show');
            @else
            $('#deleteconsultantav').modal('show');
            @endif
            @endif
        </script>
    @endif

    @php
        $url = route('getAllConsultantAV');
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
                return '<span data-id="' + row.id + '">' + data + '</span>';
            }
        },
        { data: 'user_name', name: 'user_name', orderable: true },
        { data: 'date', name: 'date', orderable: true },
        { data: 'start_time', name: 'start_time', orderable: true },
        { data: 'end_time', name: 'end_time', orderable: true },
        { 
            data: 'status', 
            name: 'status', 
            orderable: false, // Assuming you don't want to allow sorting on this column
            render: function(data, type, row) {
                if (data === 1) {
            return '<span style="color: red;">Reserved</span>';
        } else {
            return '<span style="color: green;">Available</span>';
        }
            }
        },
        { data: 'created_at', name: 'created_at', orderable: true },
        
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


<script src="{{asset('public/backend/js/consultant_list.js')}}"></script>
@endpush


