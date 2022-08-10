@extends('admin.layouts.app')
@push('breadcrumb')
    {!! Breadcrumbs::render('cities_create') !!}
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

        <!--begin::Form-->
        <form id="frmAddAddress" method="POST" action="{{ route('admin.addresses.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- State --}}
            <div class="card-body">
                  {{-- title --}}
                <div class="form-group">
                    <label for="title">Office title{!!$mend_sign!!}</label>
                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" title="title" value="{{ old('title') }}" placeholder="Enter title" autocomplete="title" spellcheck="false" autocapitalize="sentences" tabindex="0" autofocus />
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
                {{-- city --}}
                <div class="form-group">
                    <label for="city_id">City Name{!!$mend_sign!!}</label>
                    <select id="city_id" class="form-control" name="city_id">
                        <option></option>
                        @foreach($cities as $city)
                        <option value="{{ $city->id }}"> {{ $city->name }} @if($city->country) ({{ $city->country->name }}) @endif</option>
                        @endforeach
                    </select>
                    @if ($errors->has('city_id'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('city_id') }}</strong>
                        </span>
                    @endif
                </div>
                {{-- address --}}
                <div class="form-group">
                    <label for="address">Address{!!$mend_sign!!}</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Enter address" autocomplete="address" spellcheck="true"></textarea>
                    @if ($errors->has('address'))
                        <span class="text-danger">
                            <strong class="form-text">{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>
                {{-- manager_name --}}
                <div class="form-group">
                    <label for="manager_name">Office Manager Name{!!$mend_sign!!}</label>
                    <input type="text"  name="manager_name"  class="form-control @error('manager_name') is-invalid @enderror" id="manager_name" manager_name="manager_name" value="{{ old('manager_name') }}" placeholder="Enter manager_name" autocomplete="manager_name" spellcheck="false" autocapitalize="sentences" tabindex="0" autofocus />
                    @if ($errors->has('manager_name'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('manager_name') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- contact_no --}}
                <div class="form-group">
                    <label for="contact_no">Contact Number{!!$mend_sign!!}</label>
                    <input type="text" name="contact_no" id="contact_no" class="form-control @error('contact_no') is-invalid @enderror" id="contact_no" contact_no="contact_no" value="{{ old('contact_no') }}" placeholder="Enter contact_no" autocomplete="contact_no" spellcheck="false" autocapitalize="sentences" tabindex="0" autofocus />
                    @if ($errors->has('contact_no'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('contact_no') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- alternative_contact_no --}}
                <div class="form-group">
                    <label for="alternative_contact_no">Alternative Contact Number{!!$mend_sign!!}</label>
                    <input type="text" name="alternative_contact_no"  class="form-control @error('alternative_contact_no') is-invalid @enderror" id="alternative_contact_no" alternative_contact_no="alternative_contact_no" value="{{ old('alternative_contact_no') }}" placeholder="Enter alternative_contact_no" autocomplete="alternative_contact_no" spellcheck="false" autocapitalize="sentences" tabindex="0" autofocus />
                    @if ($errors->has('alternative_contact_no'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('alternative_contact_no') }}</strong>
                        </span>
                    @endif
                </div>


                {{-- Image --}}
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

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2"> Add {{ $custom_title }}</button>
                <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        <!--end::Form-->
    </div>
</div>
@endsection

@push('extra-js-scripts')
<script>
$(document).ready(function () {
    $('#state_id').select2({ placeholder: 'Select state'});
    $("#frmAddAddress").validate({
        rules: {
            title: {
                required: true,
                not_empty: true,
                minlength: 3,
            },
            city_id: {
                required: true,
                not_empty: true,
            },
            address: {
                required: true,
                not_empty: true,
                minlength: 5,
            },
            manager_name: {
                required: true,
                not_empty: true,
                minlength: 3,
            },
            contact_no: {
                required: true,
                not_empty: true,
                digits: true,
                minlength: 10,
            },
            alternative_contact_no: {
                required: true,
                not_empty: true,
                digits: true,
                minlength: 10,
            },
        },
        messages: {
            title: {
                required: "@lang('validation.required',['attribute'=>'title'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'title'])",
                minlength:"@lang('validation.min.string',['attribute'=>'title','min'=>3])",
            },
            city_id: {
                required: "@lang('validation.required',['attribute'=>'city name'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'city name'])",
                minlength:"@lang('validation.min.string',['attribute'=>'city name','min'=>3])",
            },
            address: {
                required: "@lang('validation.required',['attribute'=>'address'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'address'])",
                minlength:"@lang('validation.min.string',['attribute'=>'address','min'=>5])",
            },
            manager_name: {
                required: "@lang('validation.required',['attribute'=>'manager_name'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'manager_name'])",
                minlength:"@lang('validation.min.string',['attribute'=>'manager_name','min'=>3])",
            },
            contact_no: {
                required: "@lang('validation.required',['attribute'=>'contact_no'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'contact_no'])",
                minlength:"@lang('validation.min.string',['attribute'=>'contact_no','min'=>3])",
            },
            alternative_contact_no: {
                required: "@lang('validation.required',['attribute'=>'alternative_contact_no'])",
                not_empty: "@lang('validation.not_empty',['attribute'=>'alternative_contact_no'])",
                minlength:"@lang('validation.min.string',['attribute'=>'alternative_contact_no','min'=>3])",
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
    $('#frmAddAddress').submit(function () {
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
