<?php

namespace App\DataTables;

use App\Models\Asset;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class AssetDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('user', function($row){
                return $row->user->name ?? '';
            })
            ->addColumn('cost', function($row){
                return LocaleSettings('currency_symbol').$row->cost;
            })
            ->addColumn('status', function($row){
                return ucwords($row->status);
            })
            ->addColumn('created_at', function($row){
                return format_date($row->created_at);
            })
            ->addColumn('warranty', function($row){
                return "$row->warranty ".Str::plural(__('Month'), $row->warranty);
            })
            ->addColumn('action',function($row){
                $id = $row->id;
                return view('pages.assets.actions',compact('id'));
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Asset $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('asset-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
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
            Column::make('id'),
            Column::make('user'),
            Column::make('name'),
            Column::make('ast_id')->title(__('Asset Id')),
            Column::make('purchase_date'),
            Column::make('warranty'),
            // Column::make('warranty_end'),
            Column::make('cost'),
            Column::make('created_at'),
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
        return 'Asset_' . date('YmdHis');
    }
}
