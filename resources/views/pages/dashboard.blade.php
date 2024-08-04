@extends('layouts.app')

@push('page-styles')
    <!-- Chart CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/morris/morris.css') }}">
@endpush

@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb>
            <x-slot name="title">{{ __('Welcome') }}
                {{ !empty(auth()->user()->username) ? auth()->user()->username . ' !' : '' }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
            </ul>
        </x-breadcrumb>
        <!-- /Page Header -->

        @superadmin

        <div class="row">
            @if (!empty($projects))
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa-solid fa-cubes"></i></span>
                        <div class="dash-widget-info">
                            <h3>{{ !empty($projects) ? $projects->count(): 0 }}</h3>
                            <span>{{ __('Projects') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa-solid fa-dollar-sign"></i></span>
                        <div class="dash-widget-info">
                            <h3>{{ !empty($clients) ? $clients->count() : 0 }}</h3>
                            <span>{{ __('Clients') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa-regular fa-gem"></i></span>
                        <div class="dash-widget-info">
                            <h3>{{ !empty($tickets) ? $tickets->count(): 0 }}</h3>
                            <span>{{ __('Tickets') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa-solid fa-user"></i></span>
                        <div class="dash-widget-info">
                            <h3>{{ !empty($employees) ? $employees->count(): 0 }}</h3>
                            <span>{{ __('Employees') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">{{ __('Budget') }}</h3>
                                <div id="bar-charts"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">{{ __('Estimates & Invoices Overview') }}</h3>
                                <div id="line-charts"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">{{ __('Expenses') }}</h3>
                                <div id="monthly_expense_barchart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @if (!empty(module('Sales')))
        <div class="row">
            <div class="col-md-12">
                <div class="card-group m-b-30">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="d-block">{{ __('New Employees') }}</span>
                                </div>
                            </div>
                            <h3 class="mb-3">{{ $thisMonthTotalEmployees  }}</h3>
                            <div class="progress height-five mb-2">
                                <div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">{{ __('Previous Month Employees') }} {{ $prevMonthTotalEmployees }}</p>
                        </div>
                    </div>
                
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="d-block">{{ __('Expenses') }}</span>
                                </div>
                            </div>
                            <h3 class="mb-3">{{ LocaleSettings('currency_symbol').' '.$thisMonthExpenses }}</h3>
                            <div class="progress height-five mb-2">
                                <div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">{{ __('Previous Month') }} <span class="text-muted">{{ LocaleSettings('currency_symbol').' '.$prevMonthExpenses }}</span></p>
                        </div>
                    </div>
                
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="d-block">{{ __('Estimates') }}</span>
                                </div>
                            </div>
                            <h3 class="mb-3">{{ LocaleSettings('currency_symbol').' '.$thisMonthEstimates }}</h3>
                            <div class="progress height-five mb-2">
                                <div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">{{ __('Previous Month') }} <span class="text-muted">{{ LocaleSettings('currency_symbol').' '.$prevMonthEstimates }}</span></p>
                        </div>
                    </div>
                
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="d-block">{{ __('Invoices') }}</span>
                                </div>
                            </div>
                            <h3 class="mb-3">{{ LocaleSettings('currency_symbol').' '.$thisMonthInvoices }}</h3>
                            <div class="progress height-five mb-2">
                                <div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">{{ __('Previous Month') }} <span class="text-muted">{{ LocaleSettings('currency_symbol').' '.$thisMonthInvoices }}</span></p>
                        </div>
                    </div>
                </div>
            </div>	
        </div>
        @endif
        
        <!-- Statistics Widget -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-4 d-flex">
                <div class="card flex-fill dash-statistics">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Statistics') }}</h5>
                        <div class="stats-list">
                            @if (!empty($invoices) && $invoices->count() > 0)
                            <div class="stats-info">
                                <p>{{ __('Declined Invoices') }} <strong>{{ $invoices->where('status', '4')->count() }} <small>/ {{ $invoices->count() }}</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-danger w-31" role="progressbar" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="stats-info">
                                <p>{{ __('Partially Paid Invoices') }} <strong>{{ $invoices->where('status', '3')->count() }} <small>/ {{ $invoices->count() }}</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-info w-31" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="stats-info">
                                <p>{{ __('Paid Invoices') }} <strong>{{ $invoices->where('status', '2')->count() }} <small>/ {{ $invoices->count() }}</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-success w-31" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                                
                            <div class="stats-info">
                                <p>{{ __('Sent Invoices') }} <strong>{{ $invoices->where('status', '1')->count() }} <small>/ {{ $invoices->count() }}</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-primary w-31" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>                                
                            @endif
                            @if (!empty($tickets) && $tickets->count() > 0)
                            <div class="stats-info">
                                <p>{{ __('Open Tickets') }} <strong>{{ $tickets->where('status', \App\Enums\TicketStatus::NEW)->count() }} <small>/ {{ $tickets->count() }}</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-danger w-62" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="stats-info">
                                <p>{{ __('Closed Tickets') }} <strong>{{ $tickets->where('status', \App\Enums\TicketStatus::CLOSED)->count() }} <small>/ {{ $tickets->count() }}</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-info w-22" role="progressbar" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            @if (!empty($absentees) && $absentees->count() > 0)
            <div class="col-md-12 col-lg-6 col-xl-4 d-flex">
                <div class="card flex-fill">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('Today Absent') }} <span class="badge bg-inverse-danger ms-2">{{ $absentees->count() }}</span></h4>
                        @foreach ($absentees as $user)
                        <div class="leave-info-box">
                            <div class="media d-flex align-items-center">
                                <a @can('show-Employeeprofile') href="{{ route('employees.index') }}" @else href="#" @endcan class="avatar"><img src="{{ !empty($user->avatar) ? asset('storage/users/'.$user->avatar) : asset('images/user.jpg') }}" alt="{{ __('Image') }}"></a>
                                <div class="media-body flex-grow-1">
                                    <div class="text-sm my-0">{{ $user->fullname }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach     
                        @can('view-attendances')                  
                        <div class="load-more text-center">
                            <a class="text-dark" href="{{ route('attendances.index') }}">{{ __('Load More') }}</a>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
            @endif
        </div>
        <!-- /Statistics Widget -->
        
        @if (!empty(module('Sales')) && module('Sales')->isEnabled())
        <div class="row">
            <div class="col-md-12 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">{{ __('Invoices') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-nowrap custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('Invoice ID') }}</th>
                                        <th>{{ __('Client') }}</th>
                                        <th>{{ __('Due Date') }}</th>
                                        <th>{{ __('Total') }}</th>
                                        <th>{{ __('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($thisMonthInvoiceList))
                                        @foreach ($thisMonthInvoiceList as $invoice)
                                        <tr>
                                            <td><a @can('show-invoice') target="_blank" href="{{ route('invoices.show', ['invoice' => Crypt::encrypt($invoice->id)]) }}" @else href="#" @endcan>{{ $invoice->inv_id }}</a></td>
                                            <td>
                                                <h2>{{ $invoice->client->user->fullname ?? '' }}</h2>
                                            </td>
                                            <td>{{ format_date($invoice->expiryDate) ?? '' }}</td>
                                            <td>{{ LocaleSettings('currency_symbol') }} {{ $invoice->grand_total }}</td>
                                            <td>
                                                <span class="badge bg-inverse-{{ $invoice->statusName['color'] ?? 'primary' }}">{{ $invoice->statusName['name'] ?? '' }}</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @can('view-invoices')
                    <div class="card-footer">
                        <a target="_blank" href="{{ route('invoices.index') }}">{{ __('View all invoices') }}</a>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
        @endif
        
        <div class="row">
            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">{{ __('Clients') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        @can(['edit-client','delete-client'])
                                        <th class="text-end">{{ __('Action') }}</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($thisMonthClients) && $thisMonthClients->count() > 0)
                                        @foreach ($thisMonthClients as $client)
                                        <tr>
                                            @php
                                                $img = !empty($client->avatar) ? asset('storage/users/'.$client->avatar): asset('images/user.jpg');
                                                $link = (auth()->user()->can('show-ClientProfile')) ? route('clients.show', ['client' => Crypt::encrypt($client->id)]): '#';
                                            @endphp
                                            <td>
                                                {!! \Spatie\Menu\Laravel\Html::userAvatar($client->fullname, $img, $link) !!}
                                            </td>
                                            <td>{{ $client->email }}</td>
                                            <td>
                                                {{ $client->status->name ?? '' }}
                                            </td>
                                            @can(['edit-client','delete-client'])
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        @can('edit-client')
                                                        <a class="dropdown-item" href="javascript:void(0)" data-url="{{ route('clients.edit', ['client' => \Crypt::encrypt($client->id)]) }}" data-ajax-modal="true"
                                                            data-title="Edit Client" data-size="lg"><i class="fa-solid fa-pencil m-r-5"></i>
                                                            {{ __('Edit') }}
                                                        </a>
                                                        @endcan
                                                        @can('delete-client')
                                                        <a class="dropdown-item deleteBtn" data-route="{{ route('clients.destroy', $client->id) }}" data-title="{{ __('Delete Client') }}"
                                                            data-question="Are you sure you want to delete?" href="javascript:void(0)">
                                                            <i class="fa-regular fa-trash-can m-r-5"></i>
                                                            {{ __('Delete') }}
                                                        </a>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </td>
                                            @endcan
                                        </tr>  
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @can('view-clients')
                    <div class="card-footer">
                        <a href="{{ route('clients.index') }}">{{ __('View all clients') }}</a>
                    </div>
                    @endcan
                </div>
            </div>
            @if (module('Project') && module('Project')->isEnabled())
            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">{{ __('Recent Projects') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('Project Name') }} </th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Priority') }}</th>
                                        @can(['edit-project', 'delete-project'])   
                                        <th class="text-end">{{ __('Action') }}</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($recentProjects) && $recentProjects->count() > 0)
                                    @foreach ($recentProjects as $project) 
                                    <tr>
                                        <td>
                                            @can('show-project')
                                                <h2><a target="_blank" href="{{ route('projects.show', ['project' => \Crypt::encrypt($project->id)]) }}">{{ $project->name }}</a></h2>
                                            @else   
                                            <h2><a href="#">{{ $project->name }}</a></h2>
                                            @endcan
                                            <small class="block text-ellipsis m-b-15">
                                                <span class="text-xs">{{ $project->tasks->count() ?? 0 }}</span> <span class="text-muted">{{ __('Opened Tasks') }}</span>
                                                <span class="text-xs">{{ $project->tasks->count() ?? 0 }}</span> <span class="text-muted">{{ __('Tasks Completed') }}</span>
                                            </small>
                                        </td>
                                        
                                        <td>
                                            {{ format_date($project->startDate) }} - {{ format_date($project->endDate) }}
                                        </td>
                                        <td>
                                            {{ $project->priority }}
                                        </td>
                                        @can(['edit-project','delete-project'])
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @can('edit-project')
                                                    <a class="dropdown-item" href="javascript:void(0)" data-url="{{ route('projects.edit', ['project' => ($project->id)]) }}" data-ajax-modal="true"
                                                        data-title="Edit Project" data-size="lg">
                                                        <i class="fa-solid fa-pencil m-r-5"></i>
                                                        {{ __('Edit') }}
                                                    </a>
                                                    @endcannot
                                                    @can('delete-project')
                                                    <a class="dropdown-item deleteBtn" data-route="{{ route('projects.destroy', $project->id) }}" data-title="Delete Project"
                                                        data-question="Are you sure you want to delete project?" href="javascript:void(0)">
                                                        <i class="fa-regular fa-trash-can m-r-5"></i>
                                                        {{ __('Delete') }}
                                                    </a>
                                                    @endcan
                                                </div>
                                            </div>
                                        </td>
                                        @endcan
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @can('view-projects')
                    <div class="card-footer">
                        <a href="{{ route('projects.index') }}">{{ __('View all projects') }}</a>
                    </div>
                    @endcan
                </div>
            </div>
            @endif
        </div>


            @push('page-scripts')
            <!-- ChartJS -->
            <script defer src="{{ asset('js/plugins/morris/morris.min.js') }}"></script>
            <script defer src="{{ asset('js/plugins/raphael/raphael.min.js') }}"></script>
            <script type="module" defer>
            $(document).ready(function() {
                    let currency_symbol = "{{ LocaleSettings('currency_symbol') }}"
                    @if(!empty($budget_collection))
                    Morris.Bar({
                        element: 'bar-charts',
                        redrawOnParentResize: true,
                        data: [
                            { y: 'Jan', a: "{{$budget_collection->get(0)->sum('total_revenue')}}", b: "{{$budget_collection->get(0)->sum('total_expense')}}" },
                            { y: 'Feb', a: "{{$budget_collection->get(1)->sum('total_revenue')}}", b: "{{$budget_collection->get(1)->sum('total_expense')}}" },
                            { y: 'Mar', a: "{{$budget_collection->get(2)->sum('total_revenue')}}", b: "{{$budget_collection->get(2)->sum('total_expense')}}" },
                            { y: 'Apr', a: "{{$budget_collection->get(3)->sum('total_revenue')}}", b: "{{$budget_collection->get(3)->sum('total_expense')}}"},
                            { y: 'May', a: "{{$budget_collection->get(4)->sum('total_revenue')}}", b: "{{$budget_collection->get(4)->sum('total_expense')}}" },
                            { y: 'Jun', a: "{{$budget_collection->get(5)->sum('total_revenue')}}", b: "{{$budget_collection->get(5)->sum('total_expense')}}"},
                            { y: 'Jul', a: "{{$budget_collection->get(6)->sum('total_revenue')}}", b: "{{$budget_collection->get(6)->sum('total_expense')}}" },
                            { y: 'Aug', a: "{{$budget_collection->get(7)->sum('total_revenue')}}", b: "{{$budget_collection->get(7)->sum('total_expense')}}"},
                            { y: 'Sept', a: "{{$budget_collection->get(8)->sum('total_revenue')}}", b: "{{$budget_collection->get(8)->sum('total_expense')}}"},
                            { y: 'Oct', a: "{{$budget_collection->get(9)->sum('total_revenue')}}", b: "{{$budget_collection->get(9)->sum('total_expense')}}"},
                            { y: 'Nov', a: "{{$budget_collection->get(10)->sum('total_revenue')}}", b: "{{$budget_collection->get(10)->sum('total_expense')}}"},
                            { y: 'Dec', a: "{{$budget_collection->get(11)->sum('total_revenue')}}", b: "{{$budget_collection->get(11)->sum('total_expense')}}"},
                        ],
                        xkey: 'y',
                        ykeys: ['a', 'b'],
                        labels: ["{{ __('Expected Revenue') }}", "{{ __('Expected Expenses') }}"],
                        lineColors: ['#ff9b44','#fc6075'],
                        lineWidth: '3px',
                        barColors: ['#ff9b44','#fc6075'],
                        resize: true,
                        redraw: true
                    });
                    @endif
                    // Line Chart
                    @if(!empty($invoice_collection))
                    Morris.Line({
                        element: 'line-charts',
                        redrawOnParentResize: true,
                        data: [
                            { y: 1, a: "{{$invoice_collection->get(0)->sum('grand_total')}}", b: "{{$estimates_collection->get(0)->sum('grand_total')}}" },
                            { y: 2, a: "{{$invoice_collection->get(1)->sum('grand_total')}}", b: "{{$estimates_collection->get(1)->sum('grand_total')}}" },
                            { y: 3, a: "{{$invoice_collection->get(2)->sum('grand_total')}}", b: "{{$estimates_collection->get(2)->sum('grand_total')}}" },
                            { y: 4, a: "{{$invoice_collection->get(3)->sum('grand_total')}}", b: "{{$estimates_collection->get(3)->sum('grand_total')}}"},
                            { y: 5, a: "{{$invoice_collection->get(4)->sum('grand_total')}}", b: "{{$estimates_collection->get(4)->sum('grand_total')}}" },
                            { y: 6, a: "{{$invoice_collection->get(5)->sum('grand_total')}}", b: "{{$estimates_collection->get(5)->sum('grand_total')}}"},
                            { y: 7, a: "{{$invoice_collection->get(6)->sum('grand_total')}}", b: "{{$estimates_collection->get(6)->sum('grand_total')}}" },
                            { y: 8, a: "{{$invoice_collection->get(7)->sum('grand_total')}}", b: "{{$estimates_collection->get(7)->sum('grand_total')}}"},
                            { y: 9, a: "{{$invoice_collection->get(8)->sum('grand_total')}}", b: "{{$estimates_collection->get(8)->sum('grand_total')}}"},
                            { y: 10, a: "{{$invoice_collection->get(9)->sum('grand_total')}}", b: "{{$estimates_collection->get(9)->sum('grand_total')}}"},
                            { y: 11, a: "{{$invoice_collection->get(10)->sum('grand_total')}}", b: "{{$estimates_collection->get(10)->sum('grand_total')}}"},
                            { y: 12, a: "{{$invoice_collection->get(11)->sum('grand_total')}}", b: "{{$estimates_collection->get(11)->sum('grand_total')}}"},
                        ],
                        xkey: 'y',
                        ykeys: ['a', 'b'],
                        labels: ['Invoices', 'Estimates'],
                        lineColors: ['#ff9b44','#fc6075'],
                        lineWidth: '3px',
                        resize: true,
                        redraw: true
                    });
                    @endif
                    @if(!empty($monthly_expense))
                    Morris.Bar({
                        element: 'monthly_expense_barchart',
                        data: [
                            @if(!empty($monthly_expense))
                            @foreach ($monthly_expense as $key => $expense)
                            @php
                                $m = $key;
                            @endphp
                            { y: "{{ \Carbon\Carbon::create(0,$m,1)->format('M') }}", a: "{{ !empty($expense->get($key)) ? $expense->get($key)->sum('amount'): 0}}", b: "{{ !empty($expense->get($key)) ? $expense->get($key)->count() : 0}}"},
                            @endforeach
                            @endif
                        ],
                        xkey: 'y',
                        ykeys: ['a', 'b'],
                        labels: [`Total Expense (${currency_symbol})`, 'Total Expenses'],
                        lineColors: ['#ff9b44','#fc6075'],
                        lineWidth: '3px',
                        barColors: ['#ff9b44','#fc6075'],
                        resize: true,
                        redraw: true
                    });
                    @endif
                });
            </script>
            @endpush


        @endsuperadmin


    </div>
@endsection
