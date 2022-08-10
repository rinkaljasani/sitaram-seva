@extends('admin.layouts.app')

@push('breadcrumb')
    {!! Breadcrumbs::render('withdraws_update', $withdraw->id) !!}
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
        <form id="frmEditUser" method="POST" action="{{ route('admin.withdraws.update', $withdraw->custom_id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body">
                {{-- First Name --}}
                <div class="form-group">
                    <label for="amount">{!!$mend_sign!!}Amount:</label>
                    <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') != null ? old('amount') : $withdraw->amount }}" placeholder="Enter first name" autocomplete="amount" spellcheck="false" autocapitalize="sentences" tabindex="0" autofocus />
                    @if ($errors->has('amount'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('amount') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="status">Status{!!$mend_sign!!}</label>
                    <select id="status" class="form-control" name="status" >
                        <option value="{{ $withdraw->currancy }}">{{ $withdraw->currancy }}</option>
                        <option value="usd">usd</option>
                        <option value="cdf">cdf</option>
                    </select>
                    @if ($errors->has('status'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('status') }}</strong>
                        </span>
                    @endif
                </div>


                {{-- Country code--}}
                <div class="form-group">
                    <label for="status">Status{!!$mend_sign!!}</label>
                    <select id="status" class="form-control" name="status" >
                        <option value="{{ $withdraw->status }}">{{ $withdraw->status }}</option>
                        <option value="pending">pending</option>
                        <option value="approved">approved</option>
                        <option value="reject">reject</option>
                    </select>
                    @if ($errors->has('status'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('status') }}</strong>
                        </span>
                    @endif
                </div>

                   {{-- Shop name --}}
                <div class="form-group">
                    <label for="shop_name">{!!$mend_sign!!}Shop Name:</label>
                    <input type="text" disabled class="form-control @error('shop_name') is-invalid @enderror" id="shop_name" value="{{ old('shop_name') != null ? old('shop_name') : $withdraw->dealerShop->name }}" name="shop_name" value="{{ old('shop_name') }}" placeholder="Enter last name" autocomplete="shop_name" spellcheck="false" autocapitalize="sentences" tabindex="0" autofocus />
                    @if ($errors->has('shop_name'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('shop_name') }}</strong>
                        </span>
                    @endif
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Update {{ $custom_title }}</button>
                <a href="{{ route('admin.withdraws.index') }}" class="btn btn-secondary">Cancel</a>
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
            amount: {
                required: true,
                not_empty: true,
                minlength: 2,
                digits:true
            },
            status: {
                required: true,
                not_empty: true,
            },
            currancy: {
                required: true,
                not_empty: true,
            },
        },
        messages: {
            amount: {
                required: "@lang('validation.required',['attribute'=>'amount'])",
                digits: "@lang('validation.digits',['attribute'=>'amount'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'amount'])",
                minlength:"@lang('validation.min.string',['attribute'=>'amount','min'=>2])",
            },
            status: {
                required: "@lang('validation.required',['attribute'=>'status'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'status'])",
            },
            currancy: {
                required: "@lang('validation.required',['attribute'=>'currancy'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'currancy'])",
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
