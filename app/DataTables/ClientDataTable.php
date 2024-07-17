<?php

namespace App\DataTables;

use App\Models\User;
use App\Models\Client;
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

class ClientDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('fullname', function ($row) {
                $img = !empty($row->avatar) ? asset('storage/users/'.$row->avatar): asset('images/user.jpg');
                $link = route('clients.show', ['client' => Crypt::encrypt($row->id)]);
                return Html::userAvatar($row->fullname, $img, $link);
            })
            ->editColumn('phone', function ($row) {
                return $row->phoneNumber;
            })
            ->addColumn('clt_id', function($row){
                return $row->clientDetail->clt_id ?? 'NO-ID';
            })
            ->editColumn('created_at', function ($row) {
                if (!empty($row->created_at)) {
                    return format_date($row->created_at);
                }
            })
            ->addColumn('action', function ($row) {
                $id = $row->id;
                return view('pages.clients.action', compact(
                    'id'
                ));
            })->rawColumns(['fullname','action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->where('type',UserType::CLIENT)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('client-table')
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
            Column::make('clt_id')->title('#')->searchable(),
            Column::make('fullname')->title('Name')->searchable(),
            Column::make('username')->searchable(),
            Column::make('email')->searchable(),
            Column::make('phone')->searchable(),
            Column::make('created_at')->searchable(),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-end'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Client_' . date('YmdHis');
    }
}
