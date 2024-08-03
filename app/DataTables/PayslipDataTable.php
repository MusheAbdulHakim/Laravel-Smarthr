<?php

namespace App\DataTables;

use App\Models\Payslip;
use Spatie\Menu\Laravel\Html;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class PayslipDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))  
            ->editColumn('ps_id', function($row){
                $link = '#';
                if(auth()->user()->can('show-payslip')){
                    $link = route('payslips.show', ['payslip' => \Crypt::encrypt($row->id)]);
                }
                return '<a href="'.$link.'">'.$row->ps_id.'</a>';
            })
            ->addColumn('employee', function($row){
                $user = $row->employee->user;
                $img = !empty($user->avatar) ? asset('storage/users/'.$user->avatar): asset('images/user.jpg');
                $link = '#';
                if(auth()->user()->can('show-Employeeprofile')){
                    $link = route('employees.show', ['employee' => Crypt::encrypt($row->id)]);
                }
                return Html::userAvatar($user->fullname, $img, $link);
            })
            ->editColumn('type', function($row){
                return $row->type->name;
            })
            ->editColumn('net_pay', function($row){
                if(!empty($row->net_pay)){
                    return LocaleSettings('currency_symbol').' '.$row->net_pay;
                }
            })
            ->editColumn('created_at', function($row){
                if(!empty($row->created_at)){
                    return format_date($row->created_at);
                }
            })
            ->addColumn('payslip_date', function($row){
                if(!empty($row->payslip_date)){
                    return format_date($row->payslip_date);
                }
            })
            ->addColumn('action', function($row){
                return view('pages.payroll.payslips.actions',[
                    'id' => $row->id
                ]);
            })
            ->rawColumns(['action','ps_id','employee']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Payslip $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('payslip-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('ps_id')->title('Payslip ID'),
            Column::make('employee'),
            Column::make('type'),
            Column::make('net_pay'),
            Column::make('created_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Payslip_' . date('YmdHis');
    }
}
