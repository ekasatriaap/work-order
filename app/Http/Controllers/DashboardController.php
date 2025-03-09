<?php

namespace App\Http\Controllers;

use App\Models\TaskHd;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $view = "app.dashboard";

    public function index()
    {
        $id_user = auth()->user()->id;
        $tugas = TaskHd::where("id_penerima_tugas", $id_user)->get();
        $penugasan = TaskHd::where("id_pemberi_tugas", $id_user)->get();
        $data = [
            "title" => "Dashboard",
            "tugas_pending" => $tugas->where("status", TASK_STATUS_PENDING)->count(),
            "tugas_in_progress" => $tugas->where("status", TASK_STATUS_IN_PROGRESS)->count(),
            "tugas_completed" => $tugas->where("status", TASK_STATUS_COMPLETED)->count(),
            "tugas_canceled" => $tugas->where("status", TASK_STATUS_CANCELED)->count(),
            "penugasan_pending" => $penugasan->where("status", TASK_STATUS_PENDING)->count(),
            "penugasan_in_progress" => $penugasan->where("status", TASK_STATUS_IN_PROGRESS)->count(),
            "penugasan_completed" => $penugasan->where("status", TASK_STATUS_COMPLETED)->count(),
            "penugasan_canceled" => $penugasan->where("status", TASK_STATUS_CANCELED)->count(),
        ];
        return view($this->view, $data);
    }
}
