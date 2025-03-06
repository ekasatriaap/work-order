<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends BaseController
{
    protected $view = "app.role";
    protected $permission_name = "role";
    protected $log_name = "role";

    public function index(RoleDataTable $dataTable)
    {
        $data = [
            "title" => "Roles",
        ];
        $param = [
            "level" => auth()->user()->role?->level
        ];

        return $dataTable->setParam($param)
            ->setButton("{$this->view}.button")
            ->setPermission($this->permission_name)
            ->render($this->view . ".index", $data);
    }

    public function create()
    {
        notAjaxAbort();
        $data = [
            "role" => new Role(),
        ];
        return view("{$this->view}.create", $data);
    }

    public function store(RoleRequest $request)
    {
        notAjaxAbort();
        $attributes = $request->validated();
        DB::beginTransaction();
        try {
            $attributes['guard_name'] = GUARD_WEB;
            $store = Role::create($attributes);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = env("APP_DEBUG") ? $e->getMessage() : GAGAL_SIMPAN;
            return responseFail($message);
        }
        DB::commit();
        $this->activityCreate("Tambah {$this->log_name}", $store);
        return responseSuccess(BERHASIL_SIMPAN);
    }

    public function edit($id)
    {
        notAjaxAbort();
        $role = Role::findOrFail(decode($id));
        $data = [
            "role" => $role
        ];
        return view("{$this->view}.edit", $data);
    }

    public function update(RoleRequest $request, $id)
    {
        notAjaxAbort();
        $attributes = $request->validated();
        $role = Role::findOrFail(decode($id));
        DB::beginTransaction();
        try {
            $attributes['updated_at'] = now();
            $update = $role->update($attributes);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = env("APP_DEBUG") ? $e->getMessage() : GAGAL_SIMPAN;
            return responseFail($message);
        }
        DB::commit();
        $this->activityUpdate("Ubah {$this->log_name}", $role, json_encode($attributes));
        return responseSuccess(BERHASIL_SIMPAN);
    }

    public function show($id)
    {
        $role = Role::findOrFail(decode($id));

        $data = [
            'title' => 'Detail Role',
            'menuUsers' => getMenu(),
            'role' => $role,
            'role_permissions' => $role->getAllPermissions()->pluck('name')->toArray(),
        ];

        return view("{$this->view}.show", $data);
    }

    public function destroy($id)
    {
        notAjaxAbort();
        DB::beginTransaction();
        try {
            $role = Role::findOrFail(decode($id));
            $role->delete();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = env("APP_DEBUG") ? $e->getMessage() : GAGAL_SIMPAN;
            return responseFail($message);
        }
        DB::commit();
        $this->activityDelete("Hapus {$this->log_name}", $role);
        return responseSuccess(BERHASIL_HAPUS);
    }
}
