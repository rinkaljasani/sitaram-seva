@extends('admin.layouts.app')

@push('breadcrumb')
    {!! Breadcrumbs::render('balances_create') !!}
@endpush

@section('content')
<div class="container">
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="fas fa-user-plus text-primary"></i>
                </span>
                <h3 class="card-label text-uppercase">ADD {{ $custom_title }}</h3>
            </div>
        </div>

        <!--begin::Form-->
        <form id="frmAddUser" method="POST" action="{{ route('admin.balances.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                {{-- First Name --}}
                
    

                <div class="form-group">
                    <label for="user_id">user_id{!!$mend_sign!!}</label>
                    <select id="user_id" class="form-control" name="user_id" >
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->full_name }}</option>    
                        @endforeach
                        
                    </select>
                    @if ($errors->has('user_id'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('user_id') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="currancy">Currancy{!!$mend_sign!!}</label>
                    <select id="currancy" class="form-control" name="currancy" >
                        <option value="usd">usd</option>
                        <option value="cdf">cdf</option>
                    </select>
                    @if ($errors->has('currancy'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('currancy') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="amount">{!!$mend_sign!!}Amount:</label>
                    <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}" placeholder="Enter first name" autocomplete="amount" spellcheck="false" autocapitalize="sentences" tabindex="0" autofocus />
                    @if ($errors->has('amount'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('amount') }}</strong>
                        </span>
                    @endif
                </div>

                
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2 text-uppercase"> Add {{ $custom_title }}</button>
                <a href="{{ route('admin.balances.index') }}" class="btn btn-secondary text-uppercase">Cancel</a>
            </div>
        </form>
        <!--end::Form-->
    </div>
</div>
@endsection

@push('extra-js-scripts')
<script>
$(document).ready(function () {
    $("#frmAddUser").validate({
        rules: {
            first_name: {
                required: true,
                not_empty: true,
                minlength: 2,
            },
            last_name: {
                required: true,
                not_empty: true,
                minlength: 2,
            },
            email: {
                required: false,
                maxlength: 150,
                email: true,
                valid_email: true,
                remote: {
                    url: "{{ route('admin.check.email') }}",
                    type: "post",
                    data: {
                        _token: function() {
                            return "{{csrf_token()}}"
                        },
                        type: "user",
                    }
                },
            },
            country_code: {
                required: true,
                not_empty: true,
            },
            contact_no: {
                required: true,
                not_empty: true,
                maxlength: 16,
                minlength: 6,
                pattern: /^(\d+)(?: ?\d+)*$/,
               
            },
            birth_date: {
                required: true,
                not_empty: true,
                date: true,
            },
            gender: {
                required: true,
                not_empty: true,
            },
            interest: {
                required: false,
                not_empty: true,
            },
            profile_photo:{
                extension: "jpg|jpeg|png",
            },
        },
        messages: {
            first_name: {
                required: "@lang('validation.required',['attribute'=>'first name'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'first name'])",
                minlength:"@lang('validation.min.string',['attribute'=>'first name','min'=>2])",
            },
            last_name: {
                required: "@lang('validation.required',['attribute'=>'last name'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'last name'])",
                minlength:"@lang('validation.min.string',['attribute'=>'last name','min'=>2])",
            },
            email: {
                required: "@lang('validation.required',['attribute'=>'email address'])",
                maxlength:"@lang('validation.max.string',['attribute'=>'email address','max'=>150])",
                email:"@lang('validation.email',['attribute'=>'email address'])",
                valid_email:"@lang('validation.email',['attribute'=>'email address'])",
                remote:"@lang('validation.unique',['attribute'=>'email address'])",
            },
            contact_no: {
                required:"@lang('validation.required',['attribute'=>'contact number'])",
                not_empty:"@lang('validation.not_empty',['attribute'=>'contact number'])",
                maxlength:"@lang('validation.max.string',['attribute'=>'contact number','max'=>16])",
                minlength:"@lang('validation.min.string',['attribute'=>'contact number','min'=>6])",
                pattern:"@lang('validation.numeric',['attribute'=>'contact number'])",
                remote:"@lang('validation.unique',['attribute'=>'contact number'])",
            },
            birth_date: {
                required:"@lang('validation.required',['attribute'=>'birth date'])",
                not_empty:"@lang('validation.not_empty',['attribute'=>'birth date'])",
                date:"@lang('validation.date',['attribute'=>'birth date'])",
            },
            gender: {
                required: "@lang('validation.required',['attribute'=>'gender'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'gender'])",
            },
            interest: {
                required: "@lang('validation.required',['attribute'=>'interest'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'interest'])",
            },
            profile_photo: {
                extension:"@lang('validation.mimetypes',['attribute'=>'profile photo','value'=>'jpg|png|jpeg'])",
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
    $('#frmAddUser').submit(function () {
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
