<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Enums\UserType;
use App\Helpers\AppMenu;
use Illuminate\Support\Carbon;
use Modules\Sales\Models\Expense;
use Modules\Sales\Models\Invoice;
use LaravelLang\LocaleList\Locale;
use Modules\Sales\Models\Estimate;
use Modules\Accounting\Models\Budget;
use App\Http\Controllers\BaseController;

class DashboardController extends BaseController
{

    public function index()
    {
        $this->data['pageTitle'] = __('Dashboard');
        if(auth()->user()->type === UserType::EMPLOYEE)
        {
            return view('pages.employees.dashboard',$this->data);
        }
        $projects = null;
        if(!empty(module('Project')) && module('Project')->isEnabled()){
            $projects = \Modules\Project\Models\Project::get();
            $recentProjects = \Modules\Project\Models\Project::whereMonth('created_at', Carbon::today())->get();
        }
        $clients = User::where('type', UserType::CLIENT)->get();
        $thisMonthClients = User::where('type', UserType::CLIENT)->whereMonth('created_at', Carbon::today())->get();
        $employees = User::where('type', UserType::EMPLOYEE)->get();
        $tickets = Ticket::get();

        if(module('Sales') && module('Sales')->isEnabled()){

            $this->data['thisMonthExpenses'] = Expense::whereMonth('created_at', Carbon::now())->sum('amount');
            $this->data['prevMonthExpenses'] = Expense::whereMonth('created_at', Carbon::now()->subMonth())->sum('amount');
            
            $this->data['thisMonthEstimates'] = Estimate::whereMonth('created_at', Carbon::now())->sum('grand_total');
            $this->data['prevMonthEstimates'] = Estimate::whereMonth('created_at', Carbon::now()->subMonth())->sum('grand_total');
            
            $this->data['thisMonthInvoices'] = Invoice::whereMonth('created_at', Carbon::now())->sum('grand_total');
            $this->data['prevMonthInvoices'] = Invoice::whereMonth('created_at', Carbon::now()->subMonth())->sum('grand_total');
            $this->data['invoices'] = Invoice::get();
            
            $this->data['thisMonthInvoiceList'] = Invoice::whereMonth('created_at', Carbon::now())->get();
            $this->data['thisMonthPaidInvoiceList'] = Invoice::whereMonth('created_at', Carbon::now())->where('status', '2')->get();

            $month = 1;
            $expense_collection = collect();
            $budget_collection = collect();
            $invoice_collection = collect();
            $estimates_collection = collect();
            while ($month <= 12)
            {
                $expense_collection->push(
                   Expense::whereMonth('created_at', $month)->get()
                );
                $budget_collection->push(
                    Budget::whereMonth('created_at', $month)->get()
                );
                $invoice_collection->push(
                    Invoice::whereMonth('created_at', $month)->get()
                );
                $estimates_collection->push(
                    Estimate::whereMonth('created_at', $month)->get()
                );
                $month += 1;
            }
            $this->data['monthly_expense'] = $expense_collection;
            $this->data['budget_collection'] = $budget_collection;
            $this->data['invoice_collection'] = $invoice_collection;
            $this->data['estimates_collection'] = $estimates_collection;
        }

        $budgets = null;

        if(module('Accounting') && module('Accounting')->isEnabled()){
        
            $budgets = Budget::get(); 
        }

        
        //attendances
        $absentees = User::where('type', UserType::EMPLOYEE)->whereDoesntHave('attendances', function($query){
            return $query->whereDay('created_at', Carbon::today())->take(1);
        })->get();

        $this->data['absentees'] = $absentees;
        $this->data['thisMonthTotalEmployees'] = User::where('type', UserType::EMPLOYEE)->whereMonth('created_at', Carbon::now())->count() ?? 0;
        $this->data['prevMonthTotalEmployees'] = User::where('type', UserType::EMPLOYEE)->whereMonth('created_at', Carbon::now()->subMonth(1))->count() ?? 0;
        $this->data['clients'] = (!empty($clients) && $clients->count() > 0) ? $clients: null;
        $this->data['thisMonthClients'] = $thisMonthClients;
        $this->data['employees'] = (!empty($employees) && $employees->count() > 0) ? $employees: null;
        $this->data['tickets'] = (!empty($tickets) && $tickets->count() > 0) ? $tickets: null;
        $this->data['projects'] = $projects;
        $this->data['recentProjects'] = $recentProjects;
        return view('pages.dashboard', $this->data);
    }
}
