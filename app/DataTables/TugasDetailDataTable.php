<?php

namespace App\DataTables;

use App\Models\TaskDt;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;

class TugasDetailDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $primaryKey = (new TaskDt())->getKeyName();
        return (new EloquentDataTable($query))
            ->addColumn('aksi', function ($row) use ($primaryKey) {
                $data['id'] = encode($row->$primaryKey);
                $data['permission_name'] = $this->getPermission();
                $data['status'] = $row->status;
                return view($this->getButton(), $data);
            })
            ->editColumn("status", fn($row) => statusTask($row->status))
            ->addIndexColumn()
            ->rawColumns(['status'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TaskHd $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TaskDt $model): QueryBuilder
    {
        $param = $this->getParam();
        $id_task_hd = $param['id_task_hd'];
        return $model->with(["produk"])->where("id_task_hd", $id_task_hd);
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
            ->dom('rtip')
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
            Column::make('produk.kode_produk')->title("Kode Produk")->addClass('text-center')->width(150),
            Column::make('produk.nama_produk')->title("Nama Produk"),
            Column::make('jumlah')->addClass('text-center'),
            Column::make('jumlah_real')->title("Jumlah Realisasi")->addClass('text-center'),
            Column::make('status')->addClass('text-center')->searchable(false)->orderable(false)->width(100),
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
        return 'TugasDetail_' . date('YmdHis');
    }
}
