@extends('pages.settings.index')

@section('page-header-section')
    <!-- Page Header -->
    <x-breadcrumb>
        <x-slot name="title">{{ __('Invoice Settings') }}</x-slot>
    </x-breadcrumb>
    <!-- /Page Header -->
@endsection

@section('page-section')
    <form action="{{ route('settings.invoice.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <x-form.input-block class="row">
                    <x-form.label class="col-form-label col-lg-3">{{ __('Prefix') }}</x-form.label>
                    <div class="col-lg-9">
                        <x-form.input type="text" name="prefix" value="{{ $settings->prefix }}" />
                    </div>
                </x-form.input-block>
            </div>
            <div class="col-12">
                <x-form.input-block class="row">
                    <div class="col-lg-3">
                        <x-form.label class="col-form-label">{{ __('Logo') }}</x-form.label>
                    </div>
                    <div class="col-lg-7">
                        <x-form.input type="file" name="logo"
                            onchange="document.getElementById('logo').src = window.URL.createObjectURL(this.files[0])" />
                        <span class="form-text text-muted">{{ __('Recommended image size is 200px x 40px') }}</span>
                    </div>
                    <div class="col-lg-2">
                        <div class="img-thumbnail float-end">
                            <img id="logo" class="img-fluid"
                                src="{{ !empty($settings->logo) ? asset('storage/settings/invoice/' . $settings->logo) : asset('images/logo2.png') }}"
                                alt="logo light" width="140" height="40">
                            </div>
                    </div>
                </x-form.input-block>
            </div>
        </div>
        <div class="submit-section">
            <button class="btn btn-primary submit-btn">{{ __('Save') }}</button>
        </div>
    </form>
@endsection

@push('page-scripts')
@endpush
