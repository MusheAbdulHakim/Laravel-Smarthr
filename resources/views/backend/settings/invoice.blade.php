@extends('layouts.backend-settings')



@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
    
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Invoice Settings</h3>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
        <form action="{{route('settings.invoice')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Invoice prefix</label>
                <div class="col-lg-9">
                    <input type="text" value="{{$settings->prefix}}"name="prefix" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Invoice Logo</label>
                <div class="col-lg-7">
                    <input type="file" value="{{$settings->logo}}" class="form-control" name="logo">
                    <span class="form-text text-muted">Recommended image size is 200px x 40px</span>
                </div>
                <div class="col-lg-2">
                    <div class="img-thumbnail float-end"><img  src="{{(!empty($settings->logo) && $settings->logo != ' ') ? asset('storage/settings/invoice/'.$settings->logo): asset('assets/img/logo3.png')}}" class="img-fluid" alt="logo" width="140" height="40"></div>
                </div>
            </div>
            <div class="submit-section">
                <button type="submit" class="btn btn-primary submit-btn">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection

