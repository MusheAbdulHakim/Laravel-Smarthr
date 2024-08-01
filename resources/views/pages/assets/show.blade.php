@extends('layouts.app',['pageTitle' => __('Assets')])


@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb class="col">
            <x-slot name="title">{{ __('Assets') }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ __('Assets') }}
                </li>
            </ul>
            <x-slot name="right">
                <div class="col-auto">
                    <a href="{{ route('assets.index') }}" class="btn add-btn ms-1"
                        data-bs-toggle="tooltip" title="{{ __('Go Back') }}">
                        <i class="fa-solid fa-reply"></i>
                    </a>
                    <a href="#" class="btn btn-assign" data-bs-toggle="modal" data-bs-target="#add-assign"><i class="fa-solid fa-plus"></i> {{ __('Assign') }}  </a>
                </div>
            </x-slot>
        </x-breadcrumb>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="assets-info">
                    <h2>{{ __('Asset Info') }}</h2>
                    <ul>
                        <li>
                            <span>{{ __('Name') }}</span>
                            <p>{{ $asset->name }}</p>
                        </li>
                        <li>
                            <span>{{ __('Brand') }}</span>
                            <p>{{ $asset->brand }}</p>
                        </li>
                        <li>
                            <span>{{ __('Model') }}</span>
                            <p>{{ $asset->model }}</p>
                        </li>
                        <li>
                            <span>{{ __('Manufacturer') }}</span>
                            <p>{{ $asset->manufacturer }}</p>
                        </li>
                        <li>
                            <span>{{ __('Serial Number') }}</span>
                            <p>{{ $asset->serial_no }}</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="assets-info">
                    <h2>{{ __('Asset History') }}</h2>
                    <ul>
                        <li>
                            <span>{{ __('Supplier') }}</span>
                            <p>{{ $asset->supplier }}</p>
                        </li>
                        <li>
                            <span>Cost</span>
                            <p>{{ LocaleSettings('currency_symbol')." ".$asset->cost }}</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-12 d-flex">
                <div class="assets-info">
                    <h2>{{ __('Purchase') }}</h2>
                    <ul>
                        <li>
                            <span>{{ __('Purchase Date') }}</span>
                            <p>{{ $asset->purchase_date }}</p>
                        </li>
                        <li>
                            <span>{{ __('Purchased From') }}</span>
                            <p>{{ $asset->purchase_from }}</p>
                        </li>
                    </ul>
                    <h2>{{ __('Warranty') }}</h2>
                    <ul>
                        <li>
                            <span>{{ __('Warranty') }}</span>
                            <p>{{ $asset->warranty.' '.\Str::plural('Month',$asset->warranty) }}</p>
                        </li>
                        <li>
                            <span>{{ __('Warranty End Date') }}</span>
                            <p>{{ format_date($asset->warranty_end) }}</p>
                        </li>
                    </ul>
                </div>
            </div>
            @if (!empty($asset->files))
            <div class="col-lg-6 col-12 d-flex">
                <div class="assets-info assets-image">
                    <h2>{{ __('Asset Files') }}</h2>
                    <ul>
                        @foreach ($asset->files as $file)
                        @if (is_string($file))
                        <li>
                            <img src="{{ uploadedAsset($file,'assets') }}" width="100px" height="100px" alt="Keyboard Image">
                        </li>
                        @endif
                        @endforeach 
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection


@push('page-scripts')

@endpush