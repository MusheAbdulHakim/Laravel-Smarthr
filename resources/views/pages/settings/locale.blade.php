@extends('pages.settings.index')

@section('page-header-section')
    <!-- Page Header -->
    <x-breadcrumb>
        <x-slot name="title">{{ __('Basic Settings') }}</x-slot>
    </x-breadcrumb>
    <!-- /Page Header -->
@endsection

@section('page-section')
    <form action="{{ route('settings.locale.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Country') }}</x-form.label>
                    <select name="country" class="form-control select" id="countries">
                        @if (!empty($country))
                            <option selected value="{{ $country['iso2'] }}">{{ $country['name'] ?? '' }}</option>
                        @endif
                    </select>
                </x-form.input-block>
            </div>
            <div class="col-sm-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Timezone') }}</x-form.label>
                    <select name="timezone" class="form-control select" id="timezones">
                        <option selected value="{{ $settings->timezone }}">{{ $settings->timezone }}</option>
                    </select>
                </x-form.input-block>
            </div>
            <div class="col-sm-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Language') }}</x-form.label>
                    <select name="lang" class="form-control select" id="languages">
                        @if (!empty($language))
                            <option selected value="{{ $language['code'] ?? '' }}">{{ $language['name'] ?? '' }}</option>
                        @endif
                    </select>
                </x-form.input-block>
            </div>
            <div class="col-sm-6">
                <div class="input-block mb-3">
                    <x-form.label>{{ __('Date Format') }}</x-form.label>
                    <select class="select" name="date_format">
                        <option {{ $settings->date_format === 'd/m/Y' ? 'selected' : '' }} value="d/m/Y">15/05/2016
                        </option>
                        <option {{ $settings->date_format === 'd.m.Y' ? 'selected' : '' }} value="d.m.Y">15.05.2016
                        </option>
                        <option {{ $settings->date_format === 'd-m-Y' ? 'selected' : '' }} value="d-m-Y">15-05-2016
                        </option>
                        <option {{ $settings->date_format === 'm/d/Y' ? 'selected' : '' }} value="m/d/Y">05/15/2016
                        </option>
                        <option {{ $settings->date_format === 'Y/m/d' ? 'selected' : '' }} value="Y/m/d">2016/05/15
                        </option>
                        <option {{ $settings->date_format === 'Y-m-d' ? 'selected' : '' }} value="Y-m-d">2016-05-15
                        </option>
                        <option {{ $settings->date_format === 'M d Y' ? 'selected' : '' }} value="M d Y">May 15 2016
                        </option>
                        <option selected="selected" value="d M Y">15 May 2016</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Currency Code') }}</x-form.label>
                    <select name="currency_code" class="form-control select" id="currencies">
                        <option selected value="{{ $settings->currency_code }}">{{ $settings->currency_code }}</option>
                    </select>
                </x-form.input-block>
            </div>
            <div class="col-sm-6">
                <div class="input-block mb-3">
                    <x-form.label>{{ __('Currency Symbol') }}</x-form.label>
                    <x-form.input value="{{ $settings->currency_symbol }}" name="currency_symbol" readonly
                        id="currency_symbol" />
                </div>
            </div>
        </div>
        <div class="submit-section">
            <button class="btn btn-primary submit-btn">{{ __('Save') }}</button>
        </div>
    </form>
@endsection

@push('page-scripts')
    <script type="module">
        $(document).ready(function() {
            $('#countries').select2({
                width: "100%",
                placeholder: "Select Country",
                ajax: {
                    url: "{{ url('/api/countries') }}",
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            fields: "iso2"
                        }
                    },
                    processResults: function(response) {
                        if (response.success) {
                            return {
                                results: $.map((response.data), function(item) {
                                    return {
                                        text: item.name,
                                        id: item.iso2
                                    }
                                })
                            };
                        }
                    }
                }
            })
            $('#currencies').select2({
                width: "100%",
                placeholder: "Select Currency",
                ajax: {
                    url: "{{ url('/api/currencies') }}",
                    delay: 250,
                    data: function(params) {
                        return {
                            fields: "code,symbol",
                            search: params.term,
                        }
                    },
                    processResults: function(response) {
                        if (response.success) {
                            return {
                                results: (response.data).map(function(item) {
                                    return {
                                        id: item.code,
                                        text: item.name,
                                    }
                                })
                            };
                        }
                    }
                }
            }).on('select2:select', function() {
                let code = $(this).val();
                $.ajax({
                    url: `{{ url('/api/currencies') }}`,
                    data: {
                        filters: {
                            code: code,
                        },
                        fields: 'code,symbol',
                    },
                    success: function(e) {
                        if (e.success) {
                            let data = e.data[0];
                            console.log(data.symbol);
                            $('#currency_symbol').val(data.symbol)
                        }
                    }
                })
            })
            $('#timezones').select2({
                width: "100%",
                placeholder: "Select Timezone",
                ajax: {
                    url: "{{ url('/api/timezones') }}",
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                        }
                    },
                    processResults: function(response) {
                        if (response.success) {
                            return {
                                results: (response.data).map(function(item) {
                                    return {
                                        id: item.name,
                                        text: item.name,
                                    }
                                })
                            };
                        }
                    }
                }
            })
            $('#languages').select2({
                width: "100%",
                placeholder: "Select Language",
                ajax: {
                    url: "{{ url('/api/languages') }}",
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            fields: 'dir'
                        }
                    },
                    processResults: function(response) {
                        if (response.success) {
                            return {
                                results: (response.data).map(function(item) {
                                    return {
                                        id: item.code,
                                        text: item.name,
                                    }
                                })
                            };
                        }
                    }
                }
            }).val()
        })
    </script>
@endpush
