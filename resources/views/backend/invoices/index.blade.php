@extends('layouts.backend')

@section('styles')	
<!-- Select2 CSS -->
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.min.css')}}">
<!-- Datatable CSS -->
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
<!-- Summernote CSS -->
<link rel="stylesheet" href="{{asset('assets/plugins/summernote/dist/summernote-bs4.css')}}">

@endsection

@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">Invoices</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Invoices</li>
		</ul>
	</div>
	<div class="col-auto float-right ml-auto">
		<a href="{{route('invoices.create')}}" class="btn add-btn"><i class="fa fa-plus"></i> Create Invoice</a>
	</div>
</div>
@endsection


@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table mb-0">
				<thead>
					<tr>
						<th>#</th>
						<th>Invoice Number</th>
						<th>Client</th>
						<th>Invoice Date</th>
						<th>Due Date</th>
						<th>Amount</th>
						<th>Status</th>
						<th class="text-end">Action</th>
					</tr>
				</thead>
				<tbody>
					@php
						$count = 1;
					@endphp
					@foreach($invoices as $invoice)
					<tr>
						<td>{{$count}}</td>
						<td><a href="{{route('invoices.show',$invoice)}}">{{$invoice->inv_id}}</a></td>
						<td>{{$invoice->client->company}}</td>
						<td>{{date_format(date_create($invoice->invoice_date),'d M, Y')}}</td>
						<td>{{date_format(date_create($invoice->due_date),'d M, Y')}}</td>
						<td>{{app(App\Settings\ThemeSettings::class)->currency_symbol.' '.$invoice->total}}</td>
						<td><span class="badge bg-inverse-{{($invoice->status == 'paid') ? 'success': 'danger'}}">{{ucfirst($invoice->status)}}</span></td>
						<td class="text-end">
							<div class="dropdown dropdown-action">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{route('invoices.edit',$invoice->id)}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a class="dropdown-item" href="{{route('invoices.show',$invoice)}}"><i class="fa fa-eye m-r-5"></i> View</a>
									<a class="dropdown-item deletebtn" href="javascript:void(0)" data-id="{{$invoice->id}}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>
						</td>
					</tr>
					@php
						$count++;
					@endphp
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>   

<x-modals.delete route="invoices.destroy" title="Invoice" />
@endsection


@section('scripts')
<!-- Datatable JS -->
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<!-- Select2 JS -->
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<!-- summernote JS -->
<script src="{{asset('assets/plugins/summernote/dist/summernote-bs4.min.js')}}"></script>

@endsection