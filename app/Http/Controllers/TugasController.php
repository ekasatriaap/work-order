<?php

namespace App\Http\Controllers;

use App\DataTables\TugasDataTable;
use App\DataTables\TugasDetailDataTable;
use App\Models\TaskHd;
use Illuminate\Http\Request;

class TugasController extends BaseController
{
    protected $view = "app.tugas";
    protected $permission_name = "tugas";
    protected $log_name = "tugas";

    public function index(TugasDataTable $dataTable)
    {
        $title = "Tugas";
        return $dataTable->setPermission($this->permission_name)
            ->setButton("{$this->view}.button")
            ->setParam(["id" => auth()->user()->id])
            ->render($this->view . ".index", compact("title"));
    }

    public function edit(TugasDetailDataTable $dataTable, $id)
    {
        $id = decode($id);
        $tugas = TaskHd::with(["pemberi_tugas"])->findOrFail($id);
        $title = $tugas->no_wo;
        $details = [
            [
                "Pemberi Tugas" => $tugas->pemberi_tugas->name,
                "Status" => statusTask($tugas->status),
                "Tenggat Waktu" => tanggal($tugas->deadline, "d F Y H:i")
            ]
        ];
        return $dataTable->setPermission("tugas")
            ->setButton("{$this->view}-detail.button")
            ->setParam(["id_task_hd" => $id])
            ->render($this->view . ".edit", compact("title", "details"));
    }

    public function show($id)
    {
        notAjaxAbort();
        $id = decode($id);
        $penugasan = TaskHd::with(["task_dt.progress", 'pemberi_tugas', 'penerima_tugas'])->findOrFail($id);
        $detail = [
            [
                "No WO" => $penugasan->no_wo,
                "Pemberi Tugas" => $penugasan->pemberi_tugas->name,
            ],
            [
                "Status" => statusTask($penugasan->status),
                "Tenggat Waktu" => tanggal($penugasan->deadline, "d F Y H:i"),
            ]
        ];

        return view("{$this->view}.show", compact("penugasan", "detail"));
    }
}
