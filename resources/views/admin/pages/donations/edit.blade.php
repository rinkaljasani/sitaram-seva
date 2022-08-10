@extends('admin.layouts.app')

@push('breadcrumb')
    {!! Breadcrumbs::render('donation_update', $donation->id) !!}
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
        <form id="frmEditUser" method="POST" action="{{ route('admin.donations.update', $donation->custom_id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body">
                {{-- status --}}
                <div class="form-group">
                    <label for="status">{!!$mend_sign!!}Status</label>
                    <select type="status" class="form-control @error('status') is-invalid @enderror" id="status" name="status" autocomplete="off" spellcheck="false" tabindex="0">
                        @if($donation->status == 'pending')
                            <option value="pending" selected>pending</option>
                            <option value="approved">approved</option>
                            <option value="reject">reject</option>
                        @elseif($donation->status == 'approved')
                            <option value="approved" selected>approved</option>
                            <option value="reject">reject</option>
                        @elseif($donation->status == 'reject')
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

                
                {{-- Donar Name --}}
                <div class="form-group">
                    <label for="donar_name">{!!$mend_sign!!}Donar Name:</label>
                    <input type="text" class="form-control @error('donar_name') is-invalid @enderror" id="donar_name" name="donar_name" value="{{ old('donar_name') != null ? old('donar_name') : $donation->donar_name }}" placeholder="Enter first name" autocomplete="donar_name" spellcheck="false" autocapitalize="sentences" tabindex="0" autofocus />
                    @if ($errors->has('donar_name'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('donar_name') }}</strong>
                        </span>
                    @endif
                </div>

                
                {{-- Category--}}
                <div class="form-group">
                    <label for="category_id">Category{!!$mend_sign!!}</label>
                    <select id="category_id" class="form-control" name="category_id" >
                        {{-- <option value="{{ $donation->category }}">{{ $donation->category }}</option> --}}
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $donation->category_id ? 'selected' : '' }}> {{ $category->name }}</option>
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
                    <label for="donar_email">Donar Email:</label>
                    <input type="donar_email" class="form-control @error('donar_email') is-invalid @enderror" id="donar_email" name="donar_email" value="{{ old('donar_email') != null ? old('donar_email') : $donation->donar_email }}" placeholder="Enter donar_email" autocomplete="donar_email" spellcheck="false" tabindex="0" />
                    @if ($errors->has('donar_email'))
                        <span class="text-danger">
                            <strong class="form-text">{{ $errors->first('donar_email') }}</strong>
                        </span>
                    @endif
                </div>
                
                {{-- Profile Photo --}}
                <div class="form-group">
                    <label for="donar_image">Profile Photo</label>
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
                @if ($donation->donar_image)
                <div class="symbol symbol-120 mr-5">
                        <div class="symbol-label" style="background-image:url({{ generateURL($donation->donar_image)}})">
                        {{-- Custom css added .symbol div a --}}
                            <a href="#" class="btn btn-icon btn-light btn-hover-danger remove-img" id="kt_quick_user_close" style="width: 18px; height: 18px;">
                                <i class="ki ki-close icon-xs text-muted"></i>
                            </a>
                        </div>
                 </div>
                 @endif
                
                {{-- Amount --}}
                <div class="form-group">
                    <label for="amount">{!!$mend_sign!!}Amount:</label>
                    <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') != null ? old('amount') : $donation->amount }}" placeholder="Enter last name" autocomplete="amount" spellcheck="false" autocapitalize="sentences" tabindex="0" autofocus />
                    @if ($errors->has('amount'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('amount') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- Message --}}
                <div class="form-group">
                    <label for="message">{!!$mend_sign!!}Message :</label>
                    <textarea class="form-control @error('message') is-invalid @enderror" rows="4" id="message" name="message" placeholder="Enter about us">{{ $donation->message }}</textarea>
                    @if ($errors->has('message'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('message') }}</strong>
                        </span>
                    @endif
                </div>

                
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Update {{ $custom_title }}</button>
                <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary">Cancel</a>
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
            doner_name: {
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
