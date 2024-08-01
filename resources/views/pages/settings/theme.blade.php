@extends('pages.settings.index')

@section('page-header-section')
    <!-- Page Header -->
    <x-breadcrumb>
        <x-slot name="title">{{ __('Theme Settings') }}</x-slot>
    </x-breadcrumb>
    <!-- /Page Header -->
@endsection

@section('page-section')
    <form action="{{ route('settings.theme.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <x-form.input-block>
                    <x-form.label class="col-form-label">{{ __('App Name') }}</x-form.label>
                    <x-form.input type="text" name="name" value="{{ $settings->name }}" />
                </x-form.input-block>
            </div>
            <div class="col-12">
                <x-form.input-block class="row">
                    <x-form.label class="col-form-label">{{ __('Logo Light') }}</x-form.label>
                    <div class="col-lg-10">
                        <x-form.input type="file" name="logo_light"
                            onchange="document.getElementById('logo_light').src = window.URL.createObjectURL(this.files[0])" />
                        <span class="form-text text-muted">{{ __('Recommended image size is 40px x 40px') }}</span>
                    </div>
                    <div class="col-lg-2">
                        <div class="img-thumbnail float-end"><img id="logo_light"
                                src="{{ !empty($settings->logo_light) ? asset('storage/settings/theme/' . $settings->logo_light) : asset('images/logo2.png') }}"
                                alt="logo light" width="40" height="40"></div>
                    </div>
                </x-form.input-block>
            </div>
            <div class="col-12">
                <x-form.input-block class="row">
                    <x-form.label class="col-form-label">{{ __('Logo Dark') }}</x-form.label>
                    <div class="col-lg-10">
                        <x-form.input type="file" name="logo_dark"
                            onchange="document.getElementById('logo_dark').src = window.URL.createObjectURL(this.files[0])" />
                        <span class="form-text text-muted">{{ __('Recommended image size is 40px x 40px') }}</span>
                    </div>
                    <div class="col-lg-2">
                        <div class="img-thumbnail float-end"><img id="logo_dark"
                                src="{{ !empty($settings->logo_dark) ? asset('storage/settings/theme/' . $settings->logo_dark) : asset('images/logo2.png') }}"
                                alt="logo light" width="40" height="40"></div>
                    </div>
                </x-form.input-block>
            </div>
            <div class="col-12">
                <x-form.input-block class="row">
                    <x-form.label class="col-form-label">{{ __('Favicon') }}</x-form.label>
                    <div class="col-lg-10">
                        <x-form.input type="file" name="favicon"
                            onchange="document.getElementById('favicon').src = window.URL.createObjectURL(this.files[0])" />
                        <span class="form-text text-muted">{{ __('Recommended image size is 16px x 16px') }}</span>
                    </div>
                    <div class="col-lg-2">
                        <div class="img-thumbnail float-end">
                            <img id="favicon"
                                src="{{ !empty($settings->favicon) ? asset('storage/settings/theme/' . $settings->favicon) : asset('images/logo2.png') }}"
                                alt="Favicon img" width="16" height="16">
                        </div>
                    </div>
                </x-form.input-block>
            </div>

            {{-- <div class="col-12">
                <x-form.input-block class="row">
                    <x-form.label class="col-form-label">{{ __('Sidebar Image') }}</x-form.label>
                    <div class="col-lg-10">
                        <x-form.input type="file" name="side_img"
                            onchange="document.getElementById('side_img').src = window.URL.createObjectURL(this.files[0])" />
                    </div>
                    <div class="col-lg-2">
                        <div class="img-thumbnail float-end">
                            <img id="side_img"
                                src="{{ !empty($settings->sidebar_img) ? asset('storage/settings/theme/' . $settings->sidebar_img) : asset('images/logo2.png') }}"
                                alt="Sidebar image" width="50" height="50">
                        </div>
                    </div>
                </x-form.input-block>
            </div> --}}
            <div class="col-sm-6">
                <x-form.input-block>
                    <x-form.label class="col-form-label">Layout</x-form.label>
                    <select class="select" name="layout">
                        <option {{ $settings->layout === 'vertical' ? 'selected' : '' }} value="vertical">Vertical
                        </option>
                        <option {{ $settings->layout === 'horizontal' ? 'selected' : '' }} value="horizontal">Horizontal
                        </option>
                    </select>
                </x-form.input-block>
            </div>
            <div class="col-sm-6">
                <x-form.input-block>
                    <x-form.label class="col-form-label">Color Scheme</x-form.label>
                    <select class="select" name="color_scheme">
                        <option {{ $settings->color_scheme === 'orange' ? 'selected' : '' }} value="orange">Orange</option>
                        <option {{ $settings->color_scheme === 'light' ? 'selected' : '' }} value="light">Light</option>
                        <option {{ $settings->color_scheme === 'dark' ? 'selected' : '' }} value="dark">Dark</option>
                        <option {{ $settings->color_scheme === 'blue' ? 'selected' : '' }} value="blue">Blue</option>
                        <option {{ $settings->color_scheme === 'maroon' ? 'selected' : '' }} value="maroon">Maroon</option>
                        <option {{ $settings->color_scheme === 'purple' ? 'selected' : '' }} value="purple">Purple</option>
                    </select>
                </x-form.input-block>
            </div>
            <div class="col-sm-6">
                <x-form.input-block>
                    <x-form.label class="col-form-label">Layout Width</x-form.label>
                    <select class="select" name="layout_width">
                        <option {{ $settings->layout_width === 'fluid' ? 'selected' : '' }} value="fluid">Fluid
                        </option>
                        <option {{ $settings->layout_width === 'boxed' ? 'selected' : '' }} value="boxed">Boxed
                        </option>
                    </select>
                </x-form.input-block>
            </div>
            <div class="col-sm-6">
                <x-form.input-block>
                    <x-form.label class="col-form-label">Layout Position</x-form.label>
                    <select class="select" name="layout_pos">
                        <option {{ $settings->layout_position === 'fixed' ? 'selected' : '' }} value="fixed">Fixed
                        </option>
                        <option {{ $settings->layout_position === 'scrollable' ? 'selected' : '' }} value="scrollable">
                            Scrollable
                        </option>
                    </select>
                </x-form.input-block>
            </div>
            <div class="col-sm-6">
                <x-form.input-block>
                    <x-form.label class="col-form-label">Topbar Color</x-form.label>
                    <select class="select" name="topbar_color">
                        <option {{ $settings->topbar_color === 'default' ? 'selected' : '' }} value="default">Default
                        </option>
                        <option {{ $settings->topbar_color === 'light' ? 'selected' : '' }} value="light">Light</option>
                        <option {{ $settings->topbar_color === 'dark' ? 'selected' : '' }} value="dark">Dark</option>
                    </select>
                </x-form.input-block>
            </div>
            <div class="col-sm-6">
                <x-form.input-block>
                    <x-form.label class="col-form-label">{{ __('Sidebar Size') }}</x-form.label>
                    <select class="select" name="sidebar_size">
                        <option {{ $settings->sidebar_size === 'lg' ? 'selected' : '' }} value="default">
                            {{ __('Default') }}</option>
                        <option {{ $settings->sidebar_size === 'md' ? 'selected' : '' }} value="compact">
                            {{ __('Compact') }}</option>
                        <option {{ $settings->sidebar_size === 'sm-hover' ? 'selected' : '' }} value="compact">
                            {{ __('Small
                                                                                                                                                                                                                                                                                                                                                Hover View') }}
                        </option>
                    </select>
                </x-form.input-block>
            </div>
            <div class="col-sm-6">
                <x-form.input-block>
                    <x-form.label class="col-form-label">{{ __('Sidebar View') }}</x-form.label>
                    <select class="select" name="sidebar_view">
                        <option {{ $settings->sidebar_view === 'lg' ? 'selected' : '' }} value="default">
                            {{ __('Default') }}</option>
                        <option {{ $settings->sidebar_view === 'detached' ? 'selected' : '' }} value="detached">
                            {{ __('Detached') }}</option>
                    </select>
                </x-form.input-block>
            </div>
            <div class="col-sm-6">
                <x-form.input-block>
                    <x-form.label class="col-form-label">{{ __('Sidebar Color') }}</x-form.label>
                    <select class="select" name="sidebar_color">
                        <option {{ $settings->sidebar_color === 'light' ? 'selected' : '' }} value="light">
                            {{ __('Light') }}</option>
                        <option {{ $settings->sidebar_color === 'dark' ? 'selected' : '' }} value="dark">
                            {{ __('Dark') }}</option>
                        <option {{ $settings->sidebar_color === 'gradient' ? 'selected' : '' }} value="gradient">
                            {{ __('Gradient') }}</option>
                    </select>
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
