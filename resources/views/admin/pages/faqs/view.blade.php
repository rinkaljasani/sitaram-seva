@extends('admin.layouts.app')

@push('breadcrumb')
    {{-- {!! Breadcrumbs::render('users_show',$faq->id) !!} --}}
@endpush

@push('extra-css-styles')

@endpush

@section('content')
<div class="container">
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="{{$icon}} text-primary"></i>
                </span>
                <h3 class="card-label text-uppercase">{{ $custom_title }} Informations</h3>
            </div>
            <div class="card-toolbar">
                <div class="px-2 py-2"><a href="{{ route('admin.faqs.edit',$faq->custom_id) }}" class="btn btn-primary btn-block">Edit</a></div>
                <div class="px-2 py-2">
                    <form action="{{ route('admin.faqs.destroy',$faq->custom_id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-block">Delete</button>
                    </form>
                </div>
            </div>
           
        </div>

        <!--begin::Form-->
        <form id="frmAddUser" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-10">
                    <div class="container my-5 border-b ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex flex-column bd-highlight mb-3">
                                    <div class="p-2 bd-highlight">Question</div>
                                    <div class="px-2 mb-1 bd-highlight"><b>{{ $faq->question}}</b></div>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column bd-highlight mb-3">
                                <div class="p-2 bd-highlight">Answer</div>
                                <div class="px-2  bd-highlight"><b>{{ $faq->answer ?: 'N/A'}}</b></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
               <div class="col-md-2">
                   
               </div>
            </div>
            <!-- <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2 text-uppercase"> Add {{ $custom_title }}</button>
                {{-- <a href="{{ route('admin.skill.index') }}" class="btn btn-secondary text-uppercase">Cancel</a> --}}
            </div> -->
        </form>
     
        <!--end::Form-->
    </div>
</div>
@endsection

@push('extra-js-scripts')

<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>

    $(document).ready(function () {
        var value = $('ul.nav-tabs li a.active').data(type);
        var type = value['type'];
        tableData('all');
        
    });

    $('.tab-change').click(function(){
        oTable.destroy();
        var type = $(this).data('type');
            tableData(type);
    });

    
</script>
 
<script type="text/javascript">
    $('.tab-change').click(function(){
        var tab_type = $(this).data('type');
        if(tab_type == 'completed'){
            $('.filter').hide();
        }else{
            $('.filter').show();
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
    $(".zoom-content").hover(function() {
        $(".zoom-content").addClass('transition');
    
    }, function() {
        $(".zoom-content").removeClass('transition');
    });
});
</script>
@endpush
