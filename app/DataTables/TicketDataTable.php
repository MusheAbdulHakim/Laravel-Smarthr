<?php

namespace App\DataTables;

use App\Models\Ticket;
use App\Enums\UserType;
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

class TicketDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('last_reply', function($row){
                $reply = $row->replies()->latest()->first();
                if(!empty($reply)){
                    return $reply->created_at->diffForHumans();
                }
            })
            ->addColumn('tk_id', function($row){
                $param = ['ticket' => Crypt::encrypt($row->id)];
                return '<a href="'.route('tickets.show',$param).'">'.$row->tk_id.'</a>';
            })
            ->editColumn('status', function($row){
                return $row->status->name;
            })
            ->editColumn('priority', function($row){
                return $row->priority->name ?? '';
            })
            ->addColumn('user', function($row){
                if(!empty($row->user_id)){
                    $img = !empty($row->avatar) ? asset('storage/users/'.$row->avatar): asset('images/user.jpg');
                    $link = 'javascript:void(0)';
                    if(can('show-Employeeprofile')){
                        $link = route('employees.show', ['employee' => Crypt::encrypt($row->id)]);
                    }
                    return Html::userAvatar($row->user->fullname, $img, $link);
                }
                return __('Yet to be assigned to user');
            })
            ->addColumn('created_at', function($row){
                if(!empty($row->created_at)){
                    return format_date($row->created_at);
                }
            })
            ->addColumn('action', function($row){
                    $id = $row->id;
                    return view('pages.tickets.action',compact('id'));
            })
            ->rawColumns(['action','user','tk_id']);
    
    }

    /**
     * Get the query source of dataTable.
     */
    public function query()
    {
        if(auth()->user()->type === UserType::SUPERADMIN){
            return Ticket::query();
        }
        if(route_is('assigned-tickets')){
            return Ticket::where('user_id', auth()->user()->id)
                ->where('created_by', '!=', auth()->user()->id)
                ->newQuery();
        }
        return Ticket::where('created_by', auth()->user()->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('ticket-table')
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
            Column::make('tk_id'),
            Column::make('subject'),
            Column::make('user'),
            Column::make('created_at'),
            Column::make('priority'),
            Column::make('status'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->visible(auth()->user()->canAny(['edit-ticket','delete-ticket']))
                  ->addClass('text-end'),
            
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Ticket_' . date('YmdHis');
    }
}
