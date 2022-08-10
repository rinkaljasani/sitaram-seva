@extends('admin.layouts.app')

@push('breadcrumb')
    {!! Breadcrumbs::render('donation_create') !!}
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
        <form id="frmAddUser" method="POST" action="{{ route('admin.donations.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                {{-- donar Name --}}
                <div class="form-group">
                    <label for="donar_name">{!!$mend_sign!!}donar Name:</label>
                    <input type="text" class="form-control @error('donar_name') is-invalid @enderror" id="donar_name" name="donar_name" value="{{ old('donar_name') }}" placeholder="Enter first name" autocomplete="donar_name" spellcheck="false" autocapitalize="sentences" tabindex="0" autofocus />
                    @if ($errors->has('donar_name'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('donar_name') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- category name --}}
                <div class="form-group">
                    <label for="category_id">category name{!!$mend_sign!!}</label>
                    <select id="category_id" class="form-control" name="category_id">
                        <option>Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}"> {{ $category->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category_id'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('category_id') }}</strong>
                        </span>
                    @endif
                </div>


                {{-- Email --}}
                <div class="form-group">
                    <label for="donar_email">donar email:</label>
                    <input type="donar_email" class="form-control @error('donar_email') is-invalid @enderror" id="donar_email" name="donar_email" value="{{ old('donar_email') }}" placeholder="Enter donar_email" autocomplete="donar_email" spellcheck="false" tabindex="0" />
                    @if ($errors->has('donar_email'))
                        <span class="text-danger">
                            <strong class="form-text">{{ $errors->first('donar_email') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- Profile Photo --}}
                <div class="form-group">
                    <label for="donar_image">donar Image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="donar_image" name="donar_image" tabindex="0" />
                        <label class="custom-file-label @error('donar_image') is-invalid @enderror" for="customFile">Choose file</label>
                        @if ($errors->has('donar_image'))
                            <span class="text-danger">
                                <strong class="form-text">{{ $errors->first('donar_image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                {{-- Shop name --}}
                <div class="form-group">
                    <label for="amount">{!!$mend_sign!!}Amount:</label>
                    <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}" placeholder="Enter shop name" autocomplete="amount" spellcheck="false" autocapitalize="sentences" tabindex="0" autofocus />
                    @if ($errors->has('amount'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('amount') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- Message --}}
                <div class="form-group">
                    <label for="message">{!!$mend_sign!!}Message:</label>
                    <textarea class="form-control @error('message') is-invalid @enderror" rows="4" id="message" name="message" placeholder="Enter about us"></textarea>
                    @if ($errors->has('message'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('message') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2 text-uppercase"> Add {{ $custom_title }}</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary text-uppercase">Cancel</a>
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
                required: true,
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
                        type: "dealer",
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
            profile_photo:{
                extension: "jpg|jpeg|png",
            },
            amount: {
                required: true,
                not_empty: true,
                minlength: 2,
            },
            message: {
                required: true,
                not_empty: true,
                minlength: 15,
            },
        },
        messages: {
            donar_name: {
                required: "@lang('validation.required',['attribute'=>'first name'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'first name'])",
                minlength:"@lang('validation.min.string',['attribute'=>'first name','min'=>2])",
            },
            donar_email: {
                required: "@lang('validation.required',['attribute'=>'email address'])",
                maxlength:"@lang('validation.max.string',['attribute'=>'email address','max'=>150])",
                email:"@lang('validation.email',['attribute'=>'email address'])",
                valid_email:"@lang('validation.email',['attribute'=>'email address'])",
                remote:"@lang('validation.unique',['attribute'=>'email address'])",
            },
            donar_image: {
                extension:"@lang('validation.mimetypes',['attribute'=>'profile photo','value'=>'jpg|png|jpeg'])",
            },
            amount: {
                required: "@lang('validation.required',['attribute'=>'shop name'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'shop name'])",
                minlength:"@lang('validation.min.string',['attribute'=>'shop name','min'=>2])",
            },
            message: {
                required: "@lang('validation.required',['attribute'=>'shop address'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'shop address'])",
                minlength:"@lang('validation.min.string',['attribute'=>'shop address','min'=>15])",
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
