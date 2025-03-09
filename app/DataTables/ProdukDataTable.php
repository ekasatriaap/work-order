<?php

namespace App\DataTables;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;

class ProdukDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $primaryKey = (new Produk())->getKeyName();
        return (new EloquentDataTable($query))
            ->addColumn('aksi', function ($row) use ($primaryKey) {
                $data['id'] = encode($row->$primaryKey);
                $data['permission_name'] = $this->getPermission();

                return view($this->getButton(), $data);
            })
            ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Produk $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Produk $model): QueryBuilder
    {
        return $model->select("id", "created_at", "nama_produk", "kode_produk");
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
            ->setTableId(DATATABLE_ID)
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('frtip')
            ->orderBy(0);
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
            Column::make('kode_produk')->addClass('text-center')->width(150),
            Column::make('nama_produk'),
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
        return 'Produk_' . date('YmdHis');
    }
}
