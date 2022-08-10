@extends('admin.layouts.app')

@push('breadcrumb')
    {!! Breadcrumbs::render('volunteers_update', $volunteer->id) !!}
@endpush

@section('content')
<div class="container">
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="fas fa-user-edit text-primary"></i>
                </span>
                <h3 class="card-label text-uppercase">Edit {{ $custom_title }}</h3>
            </div>
        </div>

        <!--begin::Form-->
        <form id="frmEditUser" method="POST" action="{{ route('admin.volunteers.update', $volunteer->custom_id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body">
                {{-- status --}}
                <div class="form-group">
                    <label for="status">{!!$mend_sign!!}Status</label>
                    <select type="status" class="form-control @error('status') is-invalid @enderror" id="status" name="status" autocomplete="off" spellcheck="false" tabindex="0">
                        @if($volunteer->status == 'pending')
                            <option value="pending" selected>pending</option>
                            <option value="approved">approved</option>
                            <option value="reject">reject</option>
                        @elseif($volunteer->status == 'approved')
                            <option value="approved" selected>approved</option>
                            <option value="reject">reject</option>
                        @elseif($volunteer->status == 'reject')
                            <option value="approved">approved</option>
                            <option value="reject" selected>reject</option>
                        @endif
                    </select>
                    @if ($errors->has('status'))
                        <span class="text-danger">
                            <strong class="form-text">{{ $errors->first('status') }}</strong>
                        </span>
                    @endif
                </div>

                
                {{-- Name --}}
                <div class="form-group">
                    <label for="name">{!!$mend_sign!!}Name:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') != null ? old('name') : $volunteer->name }}" placeholder="Enter first name" autocomplete="name" spellcheck="false" autocapitalize="sentences" tabindex="0" autofocus />
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

            
                {{-- Email --}}
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') != null ? old('email') : $volunteer->email }}" placeholder="Enter email" autocomplete="email" spellcheck="false" tabindex="0" />
                    @if ($errors->has('email'))
                        <span class="text-danger">
                            <strong class="form-text">{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                
                {{-- Contact no --}}
                <div class="form-group">
                    <label for="contact_no">{!!$mend_sign!!}Contact Number:</label>
                    <input type="text" class="form-control @error('contact_no') is-invalid @enderror" id="contact_no" name="contact_no" value="{{ old('contact_no') != null ? old('contact_no') : $volunteer->contact_no }}" placeholder="Enter contact nuumber" autocomplete="contact_no" spellcheck="false" autocapitalize="sentences" tabindex="0" autofocus />
                    @if ($errors->has('contact_no'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('contact_no') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- Profile Photo --}}
                <div class="form-group">
                    <label for="image">Volunteer image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image" tabindex="0" value="{{ old('image') != null ? old('image') : $volunteer->image }}"/>
                        <label class="custom-file-label @error('image') is-invalid @enderror" for="customFile">Choose file</label>
                        @if ($errors->has('image'))
                        <span class="text-danger">
                            <strong class="form-text">{{ $errors->first('image') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                @if ($volunteer->image)
                <div class="symbol symbol-120 mr-5">
                        <div class="symbol-label" style="background-image:url({{ generateURL($volunteer->image)}})">
                        {{-- Custom css added .symbol div a --}}
                            <a href="#" class="btn btn-icon btn-light btn-hover-danger remove-img" id="kt_quick_user_close" style="width: 18px; height: 18px;">
                                <i class="ki ki-close icon-xs text-muted"></i>
                            </a>
                        </div>
                 </div>
                 @endif
               
                {{-- Message --}}
                <div class="form-group">
                    <label for="address">{!!$mend_sign!!}address :</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" rows="4" id="address" name="address" placeholder="Enter about us">{{ $volunteer->address }}</textarea>
                    @if ($errors->has('address'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>

                
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Update {{ $custom_title }}</button>
                <a href="{{ route('admin.volunteers.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        <!--end::Form-->
    </div>
</div>
@endsection

@push('extra-js-scripts')
<script>
$(document).ready(function () {
    $("#frmEditUser").validate({
        rules: {
            name: {
                required: true,
                not_empty: true,
                minlength: 2,
            },
            amount: {
                required: true,
                not_empty: true,
                minlength: 2,
            },
            message: {
                required: true,
                not_empty: true,
                maxlength: 30,
            },
            donar_email: {
                required: false,
                maxlength: 150,
                donar_email: true,
                valid_donar_email: true,
            },
            donar_image:{
                extension: "jpg|jpeg|png",
            },
            category_id:{
                required: true,
                not_empty: true,
            }
        },
        messages: {
            doner_name: {
                required: "@lang('validation.required',['attribute'=>'first name'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'first name'])",
                minlength:"@lang('validation.min.string',['attribute'=>'first name','min'=>2])",
            },
            amount: {
                required: "@lang('validation.required',['attribute'=>'last name'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'last name'])",
                minlength:"@lang('validation.min.string',['attribute'=>'last name','min'=>2])",
            },
            donar_email: {
                required: "@lang('validation.required',['attribute'=>'donar_email address'])",
                maxlength:"@lang('validation.max.string',['attribute'=>'donar_email address','max'=>150])",
                donar_email:"@lang('validation.donar_email',['attribute'=>'donar_email address'])",
                valid_donar_email:"@lang('validation.donar_email',['attribute'=>'donar_email address'])",
                remote:"@lang('validation.unique',['attribute'=>'donar_email address'])",
            },
            contact_no: {
                required:"@lang('validation.required',['attribute'=>'contact number'])",
                not_empty:"@lang('validation.not_empty',['attribute'=>'contact number'])",
                maxlength:"@lang('validation.max.string',['attribute'=>'contact number','max'=>16])",
                minlength:"@lang('validation.min.string',['attribute'=>'contact number','min'=>6])",
                pattern:"@lang('validation.numeric',['attribute'=>'contact number'])",
                remote:"@lang('validation.unique',['attribute'=>'contact number'])",
            },
            profile_photo: {
                extension:"@lang('validation.mimetypes',['attribute'=>'profile photo','value'=>'jpg|png|jpeg'])",
            },
            shop_name: {
                required: "@lang('validation.required',['attribute'=>'shop name'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'shop name'])",
                minlength:"@lang('validation.min.string',['attribute'=>'shop name','min'=>2])",
            },
            shop_address: {
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
            $(element).siblings('label').removeClass('text-danger');
        },
        errorPlacement: function (error, element) {
            if (element.attr("data-error-container")) {
                error.appendTo(element.attr("data-error-container"));
            } else {
                error.insertAfter(element);
            }
        }
    });
    $('#frmEditUser').submit(function () {
        if ($(this).valid()) {
            addOverlay();
            $("input[type=submit], input[type=button], button[type=submit]").prop("disabled", "disabled");
            return true;
        } else {
            return false;
        }
    });

    //remove the imaegs
    $(".remove-img").on('click',function(e){
        e.preventDefault();
        $(this).parents(".symbol").remove();
        $('#frmEditUser').append('<input type="hidden" name="remove_profie_photo" id="remove_image" value="removed">');
    });
});
</script>
@endpush
