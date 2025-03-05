<?php

namespace App\DataTables;

use App\Models\Peran;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class PeranDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $primaryKey = (new Peran())->getKeyName();
        return (new EloquentDataTable($query))
            ->editColumn('checkbox', function ($row) use ($primaryKey) {
                return "<input type='checkbox' checkboxitem value='{$row->$primaryKey}'>";
            })
            ->addColumn('aksi', function ($row) use ($primaryKey) {
                $data['id'] = encode($row->$primaryKey);
                $data['permission_name'] = $this->getPermission();

                return view($this->getButton(), $data);
            })
            ->addIndexColumn()
            ->rawColumns(['checkbox'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\BebanStudi $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Peran $model): QueryBuilder
    {

        return $model->orderBy('level');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->searchDelay(1000)
            ->setTableId(DATATABLE_ID) //biarkan
            ->columns($this->getColumns())
            ->addCheckbox(['checkboxheader'], 1)
            ->drawCallback(defaultDrawCallback())
            ->minifiedAjax()
            ->dom('Bfrtilp')
            ->orderBy(0)
            ->buttons(
                Button::make('reset')->action(""),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::make('created_at')->hidden()->searchable(false),
            Column::make('DT_RowIndex')->name('id')->title('No')->searchable(false)->orderable(false)->width(50)->addClass('text-center'),
            Column::make('nama_peran')->title('Role'),
            Column::make('level'),
            Column::computed('aksi')->title('')->exportable(false)->printable(false)->width(100)->addClass('text-end'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Sms_' . date('YmdHis');
    }
}
