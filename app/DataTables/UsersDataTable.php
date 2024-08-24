<?php

namespace App\DataTables;

use App\Models\User;
use App\Enums\UserType;
use Spatie\Menu\Laravel\Html;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\SearchPane;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->filter(function ($query) {
                if (request()->has('name')) {
                    $name = request('fullname');
                    $query->where(['firstname','middlename','lastname'], 'like', "%" . $name . "%");
                }
                if (request()->has('email')) {
                    $query->where('email', 'like', "%" . request('email') . "%");
                }
                if (request()->has('username')) {
                    $query->where('username', 'like', "%" . request('username') . "%");
                }
            })

            ->addIndexColumn()
            ->addColumn('fullname', function ($row) {
                $img = !empty($row->avatar) ? asset('storage/users/'.$row->avatar): asset('images/user.jpg');
                return Html::userAvatar($row->fullname, $img);
            })
            ->editColumn('phone', function ($row) {
                return $row->phoneNumber;
            })
            ->addColumn('role', function ($row) {
                if(!empty($row->roles) && $row->roles->count() > 0){
                    return implode(',', $row->roles->pluck('name')->all());
                }
            })
            ->editColumn('created_at', function ($row) {
                if (!empty($row->created_at)) {
                    return format_date($row->created_at);
                }
            })
            ->addColumn('action', function ($row) {
                $id = $row->id;
                return view('pages.users.action', compact(
                    'id'
                ));
            })->rawColumns(['fullname','action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->where('type',UserType::SUPERADMIN)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->parameters([
                'dom'          => 'Bftip',
            ])
            ->minifiedAjax()
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
            Column::make('fullname'),
            Column::make('username')->searchable(),
            Column::make('email')->searchable(),
            Column::make('phone')->searchable(),
            Column::make('role')->searchable(),
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
        return 'Users_' . date('YmdHis');
    }
}
