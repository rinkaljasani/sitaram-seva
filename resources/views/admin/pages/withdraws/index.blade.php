@extends('admin.layouts.app')

@push('breadcrumb')
    {!! Breadcrumbs::render('withdraws_list') !!}
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
                    <a href="{{ route('admin.withdraws.destroy', 0) }}" name="del_select" id="del_select" class="btn btn-sm btn-light-danger font-weight-bolder text-uppercase mr-2 delete_all_link">
                        <i class="far fa-trash-alt"></i> Delete Selected
                    </a>
                @endif
                {{-- @if (in_array('add', $permissions))
                    <a href="{{ route('admin.dealers.create') }}" class="btn btn-sm btn-primary font-weight-bolder text-uppercase">
                        <i class="fas fa-plus"></i>
                        Add {{ $custom_title }}
                    </a>
                @endif --}}
            </div>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs mb-5" role="tablist">
                <li class="nav-item">
                  <a class="nav-link tab-change active" data-toggle="tab" id="pending" data-type="pending">Pending</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link tab-change" data-toggle="tab" id="approved" data-type="approved">Approved</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link tab-change" data-toggle="tab" id="reject" data-type="reject">Reject</a>
                </li>
            </ul>

            {{--  Datatable Start  --}}
            <table class="table table-bordered table-hover table-checkable" id="withdraw_table" style="margin-top: 13px !important"></table>
            {{--  Datatable End  --}}
        </div>
    </div>
</div>
@endsection

@push('extra-js-scripts')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
    $(document).ready(function () {
        var value = $('ul.nav-tabs li a.active').data(type);
        var type = value['type'];
        tableData('pending');
        
    });

    $('.tab-change').click(function(){
        
        var type = $(this).data('type');
        oTable.destroy();
        tableData(type);
    });

    function tableData(type){
        oTable = $('#withdraw_table').DataTable({
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.withdraws.listing') }}",
                data: {
                    columnsDef: ['checkbox','dealer_shop_id', 'created_at', 'amount', 'currancy',  'active', 'action'],
                    type:type,
                },
            },
            columns: [
                { data: 'checkbox' },
                { data: 'dealer_shop_id' },
                { data: 'created_at' },
                { data: 'amount' },
                { data: 'currancy' },
                { data: 'action', responsivePriority: -1 },
            ],
            columnDefs: [
                // Specify columns titles here...
                { targets: 0, title: "<center><input type='checkbox' class='all_select'></center>", orderable: false },
                { targets: 1, title: 'Shop Name', orderable: true },
                { targets: 2, title: 'Date Time', orderable: true },
                { targets: 3, title: 'Amount', orderable: true },
                { targets: 4, title: 'Currancy Type', orderable: true },
                { targets: 5, title: 'Active', orderable: false },
                // Action buttons
                { targets: -1, title: 'Action',
                orderable: false },
            ],
            order: [
                [1, 'asc']
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
