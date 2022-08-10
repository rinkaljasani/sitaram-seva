@extends('admin.layouts.app')

@push('breadcrumb')
    {!! Breadcrumbs::render('volunteers_create') !!}
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
        <form id="frmAddUser" method="POST" action="{{ route('admin.volunteers.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                {{-- donar Name --}}
                <div class="form-group">
                    <label for="name">{!!$mend_sign!!}Name:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Enter name" autocomplete="name" spellcheck="false" autocapitalize="sentences" tabindex="0" autofocus />
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email" autocomplete="email" spellcheck="false" tabindex="0" />
                    @if ($errors->has('email'))
                        <span class="text-danger">
                            <strong class="form-text">{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- Contactnumber --}}
                <div class="form-group">
                    <label for="contact_no">{!!$mend_sign!!}contact_no:</label>
                    <input type="text" class="form-control @error('contact_no') is-invalid @enderror" id="contact_no" name="contact_no" value="{{ old('contact_no') }}" placeholder="Enter Contact number" autocomplete="contact_no" spellcheck="false" autocapitalize="sentences" tabindex="0" autofocus />
                    @if ($errors->has('contact_no'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('contact_no') }}</strong>
                        </span>
                    @endif
                </div>


                {{-- Profile Photo --}}
                <div class="form-group">
                    <label for="image">Image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image" tabindex="0" />
                        <label class="custom-file-label @error('image') is-invalid @enderror" for="customFile">Choose file</label>
                        @if ($errors->has('image'))
                            <span class="text-danger">
                                <strong class="form-text">{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                {{-- type --}}
                <div class="form-group">
                    <label for="type">Member Type{!!$mend_sign!!}</label>
                    <select id="type" class="form-control" name="type">
                        <option value="volunteer"> Volunteer</option>
                        <option value="manager"> Manager</option>
                        <option value="donar"> Doner</option>
                        
                    </select>
                    @if ($errors->has('type'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('type') }}</strong>
                        </span>
                    @endif
                </div>
                {{-- Message --}}
                <div class="form-group">
                    <label for="address">{!!$mend_sign!!}address:</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" rows="4" id="address" name="address" placeholder="Enter Address"></textarea>
                    @if ($errors->has('address'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('address') }}</strong>
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
            name: {
                required: true,
                not_empty: true,
                minlength: 2,
            },
            
            email: {
                required: true,
                maxlength: 150,
                
            },
            contact_no: {
                required: true,
                not_empty: true,
                maxlength: 16,
                minlength: 6,
                pattern: /^(\d+)(?: ?\d+)*$/,
            },
            image:{
                extension: "jpg|jpeg|png",
            },
            address: {
                required: true,
                not_empty: true,
                minlength: 5,
                maxlength: 50,
            },
        },
        messages: {
            name: {
                required: "@lang('validation.required',['attribute'=>'name'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'name'])",
                minlength:"@lang('validation.min.string',['attribute'=>'name','min'=>2])",
            },
            email: {
                required: "@lang('validation.required',['attribute'=>'email address'])",
                maxlength:"@lang('validation.max.string',['attribute'=>'email address','max'=>150])",
                
            },
            image: {
                extension:"@lang('validation.mimetypes',['attribute'=>'image','value'=>'jpg|png|jpeg'])",
            },
            contact_no: {
                required: "@lang('validation.required',['attribute'=>'contact number'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'contact number'])",
                minlength:"@lang('validation.min.string',['attribute'=>'contact number','min'=>2])",
            },
            address: {
                required: "@lang('validation.required',['attribute'=>'Address'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'Address'])",
                minlength:"@lang('validation.min.string',['attribute'=>'Address','min'=>5])",
                maxlength:"@lang('validation.max.string',['attribute'=>'Address','max'=>50])",
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
