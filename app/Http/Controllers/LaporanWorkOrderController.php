<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanWorkOrderController extends BaseController
{
    protected $view = "app.laporan-work-order";
    protected $permission_name = "laporan-work-order";
    protected $log_name = "laporan work order";

    public function index()
    {
        $title = "Laporan Work Order";
        $status = collect(TASK_STATUS);
        return view($this->view . ".index", compact("title", "status"));
    }

    public function cetak(Request $request)
    {
        $status = $request->fstatus;

        return (new CetakPDF)->laporanWorkOrder($status)->preview();
    }
}
