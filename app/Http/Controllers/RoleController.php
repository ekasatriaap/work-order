<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use App\Http\Requests\RoleRequest;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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

    public function permission(Request $request, $id)
    {
        notAjaxAbort();
        $role = Role::findById($id);
        $permissions = $request->input('permissions');
        if (!$role || !$permissions) return responseFail(DATA_TIDAK_DITEMUKAN);

        $give = [];
        $revoke = [];
        $role_permissions = $role->getAllPermissions()->pluck('name')->toArray();

        foreach ($permissions as $key => $permission) {
            $name = decode($permission['name']);
            $is_checked = $permission['is_checked'];

            if ($name) {
                if (in_array($name, $role_permissions) && $is_checked == 0) {
                    $revoke[] = $name;
                } elseif (!in_array($name, $role_permissions) && $is_checked == 1) {
                    $give[] = $name;
                }
            }
        }

        $message = [];


        DB::beginTransaction();
        try {

            if (count($give) > 0) {
                $role->givePermissionTo($give);
                $message[] = count($give) . " hak akses berhasil ditambahkan..";
            }
            if (count($revoke) > 0) {
                $role->revokePermissionTo($revoke);
                $message[] = count($revoke) . " hak akses berhasil dicabut!";
            }

            $role_permissions = $role->getAllPermissions()->pluck('name')->toArray();

            $menu = Menu::updateOrCreate(
                [
                    'id_role' => $role->id,
                ],
                [
                    'id_role' => $role->id,
                    'menu' => json_encode($this->_buildMenu($role_permissions)),
                ]
            );

            Cache::forget("menu_{$role->id}");

            $this->activityCreate("Manambah dan atau merubah hak akses " . $role->name, $menu);
            DB::commit();

            return responseSuccess((empty($message) ? 'tidak ada perubahan' : implode(', dan ', $message)));
        } catch (\Exception $e) {
            DB::rollBack();
            return responseFail(TERJADI_KESALAHAN);
        }
    }

    private function _buildMenu($permissions)
    {

        $menus = getMenu();
        $list_menu_can = [];

        foreach ($menus as $key => $menu) {

            if (!$this->_bisaAksesMenu($permissions, $menu)) {
                continue; //skip
            }

            if (!empty($menu['child'])) {

                foreach ($menu['child'] as $kc => $child) {

                    if (!$this->_bisaAksesMenu($permissions, $child)) {
                        unset($menu['child'][$kc]); //unset
                        continue; // skip
                    }

                    if (empty($child['url']) && !empty($child['child'])) {

                        foreach ($child['child'] as $ksc => $sub_child) {
                            if (empty($sub_child['url'])) {
                                unset($menu['child'][$kc]['child'][$ksc]); //unset
                                continue; //skip
                            }

                            if (!$this->_bisaAksesMenu($permissions, $sub_child)) {
                                unset($menu['child'][$kc]['child'][$ksc]); //unset
                                continue; //skip
                            }

                            unset($menu['child'][$kc]['child'][$ksc]['child']);
                        }
                    } else {

                        if (empty($child['url'])) {
                            unset($menu['child'][$kc]); //unset
                            continue; //skip
                        }
                    }
                }
            } else {
                if (empty($menu['url'])) continue;
            }

            $list_menu_can[] = $menu;
        }

        return $list_menu_can;
    }

    private function _bisaAksesMenu($permissions, $menu)
    {
        $permission_menu = getAllPermissionMenu($menu, [], 'lihat');

        foreach ($permission_menu as $perrr) {
            if (in_array($perrr, $permissions)) {
                return true;
            }
        }
        return false;
    }
}
