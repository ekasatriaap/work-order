<?php

namespace App\Http\Controllers;

use App\Traits\ActivityLogUserTrait;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    use ActivityLogUserTrait;

    protected $view = '';
    protected $title = '';
    protected $permissions = ['lihat' => 'index', 'tambah' => 'create,store', 'ubah' => 'edit,update', 'hapus' => 'destroy', 'detail' => 'show'];
    protected $permission_name = null;
    protected $activity_guard = 'user';

    public function getPermission()
    {
        return $this->permissions;
    }

    public function __construct()
    {
        // Middleware only applied to these methods
        $array_permission = $this->getPermission();
        foreach (array_keys($array_permission) as $p) {
            $this->middleware("can:{$this->permission_name}.{$p}")->only(explode(",", $array_permission[$p]));
        }

        // sharing
        view()->share('permission_name', $this->permission_name);
        view()->share('resource_view', $this->view);
    }
}
