@extends('pages.settings.index')

@section('page-header-section')
    <!-- Page Header -->
    <x-breadcrumb>
        <x-slot name="title">{{ __('Salary Settings') }}</x-slot>
    </x-breadcrumb>
    <!-- /Page Header -->
@endsection

@section('page-section')
    <form action="{{ route('settings.salary.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <!-- DA and HRA Settings -->
        <div class="settings-widget">
            <div class="h3 card-title with-switch">
                {{ __('DA and HRA ') }}											
                <div class="onoffswitch">
                    <input type="checkbox" name="enable_da_hra" class="onoffswitch-checkbox" id="switch_hra" {{ !empty($settings->enable_da_hra) ? 'checked':'' }}>
                    <label class="onoffswitch-label" for="switch_hra">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="input-block mb-3">
                        <label class="col-form-label">{{ __('DA') }} (%)</label>
                        <input type="text" class="form-control" name="da_percent" value="{{ $settings->da_percent }}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input-block mb-3">
                        <label class="col-form-label">{{ __('HRA') }} (%)</label>
                        <input class="form-control" type="text" name="hra_percent" value="{{ $settings->hra_percent }}">
                    </div>
                </div>
            </div>
        </div>
        <!-- /DA and HRA Settings -->
        
        <!-- Provident Fund Settings -->
        <div class="settings-widget">
            <div class="h3 card-title with-switch">
                {{ __('Provident Fund Settings') }} 											
                <div class="onoffswitch">
                    <input type="checkbox" name="enable_pf" class="onoffswitch-checkbox" id="switch_pf" {{ !empty($settings->enable_provident_fund) ? 'checked': ''}}>
                    <label class="onoffswitch-label" for="switch_pf">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="input-block mb-3">
                        <label class="col-form-label">{{ __('Employee Share') }} (%)</label>
                        <input class="form-control" type="text" name="emp_pf" value="{{ $settings->emp_pf_percentage }}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input-block mb-3">
                        <label class="col-form-label">{{ __('Organization Share') }} (%)</label>
                        <input class="form-control" type="text" name="company_pf" value="{{ $settings->company_pf_percentage }}">
                    </div>
                </div>
            </div>
        </div>
        <!-- /Provident Fund Settings -->
        
        <!-- ESI Settings -->
        <div class="settings-widget">
            <div class="h3 card-title with-switch">
                {{ __('ESI Settings') }} 											
                <div class="onoffswitch">
                    <input type="checkbox" name="enable_esi" class="onoffswitch-checkbox" id="switch_esi" {{ !empty($settings->enable_esi_fund) ? 'checked': '' }}>
                    <label class="onoffswitch-label" for="switch_esi">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="input-block mb-3">
                        <label class="col-form-label">{{ __('Employee Share') }} (%)</label>
                        <input class="form-control" type="text" name="emp_esi" value="{{ $settings->emp_esi_percentage }}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input-block mb-3">
                        <label class="col-form-label">{{ __('Organization Share') }} (%)</label>
                        <input class="form-control" type="text" name="company_esi" value="{{ $settings->company_esi_percentage }}">
                    </div>
                </div>
            </div>
        </div>
        <!-- /ESI Settings -->
        <div class="submit-section">
            <button class="btn btn-primary submit-btn">{{ __('Save') }}</button>
        </div>
    </form>
@endsection

@push('page-scripts')
@endpush
