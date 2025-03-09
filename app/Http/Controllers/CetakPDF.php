<?php

namespace App\Http\Controllers;

use App\Models\TaskHd;
use App\Models\User;
use App\Services\PdfService;

class CetakPDF
{
    protected $pdfService;
    public function __construct()
    {
        $this->pdfService = new PdfService;
    }

    public function laporanWorkOrder($status = null)
    {
        $title = "Laporan Work Order";
        $is_root = auth()->user()->is_root;
        $id_user = auth()->user()->id;
        $tasks = TaskHd::with(["penerima_tugas.role", "task_dt.progress", "task_dt.produk"])
            ->when(!$is_root, fn($query) => $query->where("id_pemberi_tugas", $id_user))
            ->when($status, fn($query) => $query->where("status", $status))
            ->get();
        $data = [
            "title" => $title,
            "status" => $status ?? "semua",
            "tasks" => $tasks
        ];
        return $this->pdfService->setView("app.laporan-work-order.cetak")
            ->setTitle($title)
            ->setPaper("a4", "landscape")
            ->setData($data);
    }

    public function laporanPertugas($id_user)
    {
        $id_pemberi_tugas = auth()->user()->id;
        $is_root = auth()->user()->is_root;
        $title = "Laporan Petugas";
        $tasks = TaskHd::with(["task_dt.progress", "task_dt.produk"])
            ->when(!$is_root, fn($query) => $query->where("id_pemberi_tugas", $id_pemberi_tugas))
            ->where("id_penerima_tugas", $id_user)
            ->get();
        $penerima_tugas = User::findOrFail($id_user);
        $data = [
            "title" => $title,
            "tasks" => $tasks,
            "penerima_tugas" => $penerima_tugas
        ];
        return $this->pdfService->setView("app.laporan-petugas.cetak")
            ->setTitle($title)
            ->setPaper("a4", "landscape")
            ->setData($data);
    }
}
