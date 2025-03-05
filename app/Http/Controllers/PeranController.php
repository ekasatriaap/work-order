<?php

namespace App\Http\Controllers;

use App\DataTables\PeranDataTable;
use Illuminate\Http\Request;

class PeranController extends BaseController
{
    protected $view = "app.peran";
    protected $permission_name = "peran";
    protected $log_name = "peran";

    public function index(PeranDataTable $dataTable)
    {
        $data = [
            "title" => "Roles",
        ];

        return $dataTable->render($this->view . ".index", $data);
    }
}
