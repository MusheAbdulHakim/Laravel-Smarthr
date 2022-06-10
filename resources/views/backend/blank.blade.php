@extends('layouts.backend')

@section('styles')
    
@endsection

@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">Blank Page</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Blank</li>
		</ul>
	</div>
	<div class="col-auto float-right ml-auto">
		<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_modal"><i class="fa fa-plus"></i> Add Modal</a>
	</div>
</div>
@endsection


@section('content')
    
@endsection


@section('scripts')
    
@endsection