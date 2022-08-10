@extends('admin.layouts.app')

@push('breadcrumb')
    {!! Breadcrumbs::render('users_list') !!}
@endpush

@push('extra-css-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" />
@endpush

@section('content')
    <div class="container">

        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="fas fa-users text-primary"></i>
                    </span>
                    <h3 class="card-label">{{ $custom_title }}</h3>
                </div>

                <div class="card-toolbar">
                    @if (in_array('delete', $permissions))
                        <a href="{{ route('admin.gallery.destroy', 0) }}" name="del_select" id="del_select"
                            class="btn btn-sm btn-light-danger font-weight-bolder text-uppercase mr-2 delete_all_link">
                            <i class="far fa-trash-alt"></i> Delete Selected
                        </a>
                    @endif
                    @if (in_array('add', $permissions))
                        <a href="{{ route('admin.gallery.create') }}"
                            class="btn btn-sm btn-primary font-weight-bolder text-uppercase">
                            <i class="fas fa-plus"></i>
                            Add {{ $custom_title }}
                        </a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs mb-5" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link tab-change active" data-toggle="tab" id="image" data-type="image">Image</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link tab-change" data-toggle="tab" id="video" data-type="video">Video</a>
                    </li>
                </ul>
                {{-- Datatable Start --}}
                <table class="table table-bordered table-hover table-checkable" id="galleryTable"
                    style="margin-top: 13px !important"></table>
                {{-- Datatable End --}}
            </div>
        </div>
    </div>
@endsection

@push('extra-js-scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $(document).ready(function() {
           
        var value = $('ul.nav-tabs li a.active').data(type);
        var type = value['type'];
        tableData('image');
        
        });

        $('.tab-change').click(function(){
            var type = $(this).data('type');
            console.log(type);
            oTable.destroy();
            tableData(type);
        });
        // datatable
        function tableData(type){
            oTable = $('#galleryTable').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.gallery.listing') }}",
                    data: {
                        columnsDef: ['checkbox', 'number','image','created_at', 'active', 'action'],
                        type:type,
                    },
                },
                columns: [{
                        data: 'checkbox'
                    },
                    {
                        data: 'number'
                    },
                    {
                        data: 'image'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'active'
                    },
                    {
                        data: 'action',
                        responsivePriority: -1
                    },
                ],
                columnDefs: [
                    // Specify columns titles here...
                    {
                        targets: 0,
                        title: "<center><input type='checkbox' class='all_select'></center>",
                        orderable: false
                    },
                    {
                        targets: 1,
                        title: 'Sr no',
                        orderable: false
                    },
                    {
                        targets: 2,
                        title: 'Image',
                        orderable: false
                    },
                    {
                        targets: 3,
                        title: 'Add Date',
                        orderable: true
                    },
                    {
                        targets: 4,
                        title: 'Active',
                        orderable: false
                    },
                    // Action buttons
                    {
                        targets: -1,
                        title: 'Action',
                        orderable: false
                    },
                ],
                order: [
                    [3, 'asc']
                ],
                lengthMenu: [
                    [10, 20, 50, 100],
                    [10, 20, 50, 100]
                ],
                pageLength: 10,
            });
        }
        
    </script>
@endpush
