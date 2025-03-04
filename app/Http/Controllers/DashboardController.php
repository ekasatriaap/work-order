<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    protected $view = "app.dashboard";
    protected $permission_name = "dashboard";

    public function index()
    {
        $data = [
            "title" => "Dashboard",
            "work_order_pending" => 100
        ];
        return view($this->view, $data);
    }
}
