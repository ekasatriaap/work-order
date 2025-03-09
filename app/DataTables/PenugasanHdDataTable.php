<?php

namespace App\DataTables;

use App\Models\TaskHd;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;

class PenugasanHdDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $primaryKey = (new TaskHd())->getKeyName();
        return (new EloquentDataTable($query))
            ->addColumn('aksi', function ($row) use ($primaryKey) {
                $data['id'] = encode($row->$primaryKey);
                $data['permission_name'] = $this->getPermission();
                $data['status'] = $row->status;
                return view($this->getButton(), $data);
            })
            ->editColumn("deadline", fn($row) => tanggal($row->deadline, 'd F Y, H:i'))
            ->editColumn("tanggal_dibuat", fn($row) => tanggal($row->created_at, 'd F Y'))
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
    public function query(TaskHd $model): QueryBuilder
    {
        $param = $this->getParam();
        $id = $param['id'];
        $is_root = $param['is_root'];
        $fstatus = $this->request->get("fstatus") ?? null;
        $ftanggal = $this->request->get("ftanggal") ?? null;
        return $model->with(["pemberi_tugas", "penerima_tugas"])
            ->when($fstatus, fn($query) => $query->where("status", $fstatus))
            ->when($ftanggal, fn($query) => $query->whereDate("created_at", $ftanggal))
            ->when(!$is_root, fn($query) => $query->where("id", $id));
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
            Column::make('no_wo')->addClass('text-center')->width(150),
            Column::make('pemberi_tugas.name')->title("Pemberi Tugas"),
            Column::make('penerima_tugas.name')->title("Penerima Tugas"),
            Column::make("tanggal_dibuat")->title("Tanggal Dibuat")->addClass('text-center')->searchable(false)->orderable(false),
            Column::make('deadline')->title("Tenggat Waktu")->addClass('text-center')->searchable(false)->orderable(false),
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
        return 'PenugasanHd_' . date('YmdHis');
    }
}
