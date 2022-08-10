@extends('admin.layouts.app')
@push('breadcrumb')
    {{-- {!! Breadcrumbs::render('cms_update', $page->id) !!} --}}
@endpush

@section('content')
<div class="container">
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="{{$icon}} text-primary"></i>
                </span>
                <h3 class="card-label text-uppercase">Edit {{ $custom_title }}</h3>
            </div>
        </div>

        <!--begin::Form-->
        <form id="frmEditcms" method="POST" action="{{ route('admin.pages.store',) }}" enctype="multipart/form-data">
            @csrf
            {{-- @method('put') --}}
            <div class="card-body">

                {{--  Name --}}
                <div class="form-group">
                    <label for="title">Title{!!$mend_sign!!}</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter title" autocomplete="title" spellcheck="false" autocapitalize="sentences" tabindex="0" autofocus />
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong class="form-text">{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- Description --}}
                <div class="form-group">
                    <label for="description">Description{!!$mend_sign!!}</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Enter description" autocomplete="description" spellcheck="true"></textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">
                            <strong class="form-text">{{ $errors->first('description') }}</strong>
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
                <button type="submit" class="btn btn-primary mr-2">Update {{ $custom_title }}</button>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        <!--end::Form-->
    </div>
</div>
@endsection

@push('extra-js-scripts')
@endpush
