@extends('admin.layouts.app')

@push('breadcrumb')
    {!! Breadcrumbs::render('faqs_create') !!}
@endpush

@section('content')
<div class="container">
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="{{$icon}} text-primary"></i>
                </span>
                <h3 class="card-label text-uppercase">ADD {{ $custom_title }}</h3>
            </div>
        </div>
        <form id="frmAddFaq" name="frmAddFaq" method="POST" action="{{ route('admin.faqs.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body ">
                        <div class="profile-content">
                            <div class="col-md-12">

                                {{-- Question --}}
                                <div class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
                                    <label for="question">{!! $mend_sign !!}Question</label>
                                    <input type="text" placeholder="Enter Question Here" class="form-control" id="question" name="question" maxlength="500" autocomplete="off" value="{{ old('question') }}" />
                                    @if($errors->has('question'))
                                        <span class="help-block">
                                            {{ $errors->first('question') }}
                                        </span>
                                    @endif
                                </div>

                                {{-- answer --}}
                                <div class="form-group {{ $errors->has('answer') ? 'has-error' : '' }}">
                                    <label for="answer">{!! $mend_sign !!}Answer</label>
                                    <textarea rows="5" placeholder="Enter Answer Here" class="form-control" id="answer" name="answer" autocomplete="off" data-error-container="#error-answer">{!! old('answer', '') !!}</textarea>
                                    <span id="error-answer"></span>
                                    @if($errors->has('answer'))
                                        <span class="help-block">
                                            {{ $errors->first('answer') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2 text-uppercase"> Add {{ $custom_title }}</button>
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary text-uppercase">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('extra-js-scripts')
{{-- <script src="{{ asset('admin/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script> --}}
<script type="text/javascript">
    // CKEDITOR.replace("answer", {
    //     filebrowserUploadMethod: 'form',
    //     uiColor: '#e1e1e1',
    // });
       
    $(document).ready(function () {
        $("#frmAddFaq").validate({
            ignore: [],
            rules: {
                question: {
                    required: true,
                    not_empty: true,
                    // minlenght:5,
                    maxlength: 500,
                },
                answer: {
                    required: true,
                    not_empty:true,
                    // minlenght:5,
                    maxlength:500
                },
            },
            messages: {
                question:{
                    required:"@lang('validation.required',['attribute'=>'question'])",
                    not_empty:"@lang('validation.not_empty',['attribute'=>'question'])",
                    maxlength:"@lang('validation.max.string',['attribute'=>'question','max'=>500])",
                },
                answer:{
                    required:"@lang('validation.required',['attribute'=>'question'])",
                    not_empty:"@lang('validation.not_empty',['attribute'=>'question'])",
                    maxlength:"@lang('validation.max.string',['attribute'=>'question','max'=>500])",
                },
            },
            errorClass: 'invalid-feedback',
            errorElement: 'span',
            highlight: function (element) {
                $(element).addClass('is-invalid');
                $(element).siblings('label').addClass('text-danger'); // For Label
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
                $(element).siblings('label').removeClass('text-danger'); // For Label
            },
            errorPlacement: function (error, element) {
                if (element.attr("data-error-container")) {
                    error.appendTo(element.attr("data-error-container"));
                } else {
                    error.insertAfter(element);
                }
            }
        });
        $('#frmAddFaq').submit(function () {
            if ($(this).valid()) {
                addOverlay();
                $("input[type=submit], input[type=button], button[type=submit]").prop("disabled", "disabled");
                return true;
            } else {
                return false;
            }
        });
    });

</script>
@endpush
