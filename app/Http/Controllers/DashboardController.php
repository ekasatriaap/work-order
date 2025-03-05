<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $view = "app.dashboard";

    public function index()
    {
        $data = [
            "title" => "Dashboard",
            "work_order_pending" => 100
        ];
        return view($this->view, $data);
    }
}
