@extends('admin.layouts.app')

@push('breadcrumb')
    {!! Breadcrumbs::render('balances_list') !!}
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
                        <a href="{{ route('admin.balances.destroy', 0) }}" name="del_select" id="del_select"
                            class="btn btn-sm btn-light-danger font-weight-bolder text-uppercase mr-2 delete_all_link">
                            <i class="far fa-trash-alt"></i> Delete Selected
                        </a>
                    @endif
                    @if (in_array('add', $permissions))
                        <a href="{{ route('admin.balances.create') }}"
                            class="btn btn-sm btn-primary font-weight-bolder text-uppercase">
                            <i class="fas fa-plus"></i>
                            Add {{ $custom_title }}
                        </a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="">Currancy Type</label>
                        <select class="form-control select2" id="currancy" name="currancy">
                            <option value="all">All</option>
                            <option value="usd">USD</option>                    
                            <option value="cdf">CDF</option>                       
                        </select>
                    </div>
                </div>
                {{-- Datatable Start --}}
                <table class="table table-bordered table-hover table-checkable" id="balances_table"
                    style="margin-top: 13px !important"></table>
                {{-- Datatable End --}}
            </div>
        </div>
    </div>
@endsection

@push('extra-js-scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
         $(document).ready(function () {
        dataTableValue();
        // datatable
        function dataTableValue()
        {
            let currancy = $('#currancy').val()

            oTable = $('#balances_table').DataTable({
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.balances.listing') }}",
                data: {
                    columnsDef: ['checkbox','id' ,'user_name', 'created_at', 'amount','currancy'],
                    currancy: currancy,
                },
            },
            columns: [
                { data: 'checkbox' },
                { data: 'id' },
                { data: 'user_name' },
                { data: 'created_at' },
                { data: 'amount' },
                { data: 'currancy' },
                { data: 'action', responsivePriority: -1 },

            ],
            columnDefs: [
                // Specify columns titles here...
                { targets: 0, title: "<center><input type='checkbox' class='all_select'></center>", orderable: false },
                { targets: 1, title: 'Transaction Id', orderable: true },
                { targets: 2, title: 'Client Name', orderable: false },
                { targets: 3, title: 'Date and Time', orderable: true },
                { targets: 4, title: 'Amount', orderable: true },
                { targets: 5, title: 'Currancy', orderable: true },
                // Action buttons
                { targets: -1, title: 'Action', orderable: false},
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
        $('#currancy').on('change',function(){
            oTable.destroy();
            dataTableValue();
        })

        $('#transaction_type').on('change',function(){
            oTable.destroy();
            dataTableValue();
        })
    });


    // placeholder for drop down menu
    $('#currancy').select2({
        placeholder: "Select a currancy"
    });
    </script>
@endpush
