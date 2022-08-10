@extends('admin.layouts.app')

@push('breadcrumb')
    {!! Breadcrumbs::render('users_update', $event->id) !!}
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
        <form id="frmEditUser" method="POST" action="{{ route('admin.events.update', $event->custom_id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body">
                {{-- name --}}
                <div class="form-group">
                    <label for="name">Name{!!$mend_sign!!}</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') != null ? old('name') : $event->name }}" placeholder="Enter name" autocomplete="name" autofocus />
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- benifical --}}
                <div class="form-group">
                    <label for="benifical">benifical{!!$mend_sign!!}</label>
                    <input type="text" class="form-control @error('benifical') is-invalid @enderror" id="benifical" name="benifical" value="{{ old('benifical') != null ? old('benifical') : $event->benifical }}" placeholder="Enter benifical" autocomplete="benifical" autofocus />
                    @if ($errors->has('benifical'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('benifical') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- Profile Photo --}}
                <div class="form-group">
                    <label for="image">Image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image" tabindex="0" value="{{ old('image') != null ? old('image') : $event->image }}"/>
                        <label class="custom-file-label @error('image') is-invalid @enderror" for="customFile">Choose file</label>
                        @if ($errors->has('image'))
                        <span class="text-danger">
                            <strong class="form-text">{{ $errors->first('image') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                @if ($event->image)
                <div class="symbol symbol-120 mr-5">
                        <div class="symbol-label" style="background-image:url({{ generateURL($event->image)}})">
                        {{-- Custom css added .symbol div a --}}
                            <a href="#" class="btn btn-icon btn-light btn-hover-danger remove-img" id="kt_quick_user_close" style="width: 18px; height: 18px;">
                                <i class="ki ki-close icon-xs text-muted"></i>
                            </a>
                        </div>
                 </div>
                 @endif
                 {{-- description --}}
                <div class="form-group">
                    <label for="description">Description{!!$mend_sign!!}</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Enter description" autocomplete="description" spellcheck="true">{{  $event->description }}</textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">
                            <strong class="form-text">{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
                {{-- location --}}
                <div class="form-group">
                    <label for="location">location{!!$mend_sign!!}</label>
                    <textarea class="form-control @error('location') is-invalid @enderror" id="location" name="location" placeholder="Enter location" autocomplete="location" spellcheck="true">{{  $event->location }}</textarea>
                    @if ($errors->has('location'))
                        <span class="text-danger">
                            <strong class="form-text">{{ $errors->first('location') }}</strong>
                        </span>
                    @endif
                </div>
                {{-- category --}}
                <div class="form-group">
                    <label for="category_id">Category Name{!!$mend_sign!!}</label>
                    <select id="category_id" class="form-control" name="category_id">
                        <option></option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}"> {{ $category->name }} @if($category->country) ({{ $category->country->name }}) @endif</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category_id'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('category_id') }}</strong>
                        </span>
                    @endif
                </div>
                {{-- date /time --}}
                <div class="form-group col-4">     
                    <label for="location">Date/Time{!!$mend_sign!!}</label>
                    <div  id='dtpickerdemo' style='padding-right:1px, padding-left:1px left:1px!important' class='input-group date @error('event_at') is-invalid @enderror' id="event_at" name="event_at" placeholder="Enter event_at" autocomplete="event_at" spellcheck="true">
                        <input type='text' class="form-control" id="event_at" name="event_at" value="{{ old('event_at') != null ? old('event_at') : $event->event_at }}"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>     
                </div>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Update {{ $custom_title }}</button>
                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        <!--end::Form-->
    </div>
</div>
@endsection

@push('extra-js-scripts')
<script>
$(function () {
 
 $('#dtpickerdemo').datetimepicker();
  
 });
 
$(document).ready(function () {
    $("#frmEditUser").validate({
        rules: {
            name: {
                required: true,
                not_empty: true,
                minlength: 3,
            },
            benifical: {
                required: true,
                not_empty: true,
                number: true,
            },
            image:{
                required:true,
                extension: "jpg|jpeg|png",
            },
            description: {
                required: true,
                not_empty: true,
                minlength: 5,
            },
            location: {
                required: true,
                not_empty: true,
                minlength: 5,
            },
            event_at: {
                required: true,
                not_empty: true
            },
        
        },
        messages: {
            name: {
                required: "@lang('validation.required',['attribute'=>'name'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'name'])",
                minlength:"@lang('validation.min.string',['attribute'=>'name','min'=>3])",
            },
            benifical: {
                required: "@lang('validation.required',['attribute'=>'benifical'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'benifical'])",
                number:"@lang('validation.min.string',['attribute'=>'benifical','min'=>3])",
            },
            image: {
                extension:"@lang('validation.mimetypes',['attribute'=>'profile photo','value'=>'jpg|png|jpeg'])",
            },
            address: {
                required: "@lang('validation.required',['attribute'=>'address'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'address'])",
                minlength:"@lang('validation.min.string',['attribute'=>'address','min'=>5])",
            },
            location: {
                required: "@lang('validation.required',['attribute'=>'location'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'location'])",
                minlength:"@lang('validation.min.string',['attribute'=>'location','min'=>5])",
            },
            event_at: {
                required: "@lang('validation.required',['attribute'=>'event_at'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'event_at'])",
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
