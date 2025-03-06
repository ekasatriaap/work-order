<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    protected $view = "app.user";
    protected $permission_name = "user";
    protected $log_name = "user";

    public function index(UserDataTable $dataTable)
    {
        $data = [
            "title" => "Users",
        ];
        $auth = auth()->user();
        $param = [
            "level" => $auth->role?->level,
            "id" => $auth->id
        ];

        return $dataTable->setPermission($this->permission_name)
            ->setParam($param)
            ->setButton("{$this->view}.button")
            ->render($this->view . ".index", $data);
    }

    public function create()
    {
        notAjaxAbort();
        $level = auth()->user()->role?->level ?? 0;
        $data = [
            "user" => new User(),
            "roles" => Role::where("level", ">", $level)->pluck("name", "id"),
        ];

        return view("{$this->view}.create", $data);
    }

    public function store(UserRequest $request)
    {
        notAjaxAbort();
        $attributes = $request->validated();
        DB::beginTransaction();
        try {
            $attributes["password"] = bcrypt($attributes["username"]);
            $user = User::create($attributes);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = env("APP_DEBUG") ? $e->getMessage() : GAGAL_SIMPAN;
            return responseFail($message);
        }
        DB::commit();
        $this->activityCreate("Tambah {$this->log_name}", $user);
        return responseSuccess(BERHASIL_SIMPAN);
    }

    public function edit($id)
    {
        notAjaxAbort();
        $id = decode($id);
        $level = auth()->user()->role?->level ?? 0;
        $user = User::findOrFail($id);
        $roles = Role::where("level", ">", $level)->pluck("name", "id");
        $data = [
            "user" => $user,
            "roles" => $roles,
        ];
        return view("{$this->view}.edit", $data);
    }

    public function update(Request $request, $id)
    {
        notAjaxAbort();
        $id = decode($id);
        $formRequest = new UserRequest();
        $validator = Validator::make($request->all(), $formRequest->rules($id), [], $formRequest->attributes());
        $attributes = $validator->validated();
        $user = User::findOrFail($id);
        DB::beginTransaction();
        try {
            $user->update($attributes);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = env("APP_DEBUG") ? $e->getMessage() : GAGAL_SIMPAN;
            return responseFail($message);
        }
        DB::commit();
        $this->activityUpdate("Ubah {$this->log_name}", $user, $user->getChanges());
        return responseSuccess(BERHASIL_SIMPAN);
    }

    public function destroy($id)
    {
        notAjaxAbort();
        $id = decode($id);
        $user = User::findOrFail($id);
        DB::beginTransaction();
        try {
            $user->delete();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = env("APP_DEBUG") ? $e->getMessage() : GAGAL_SIMPAN;
            return responseFail($message);
        }
        DB::commit();
        $this->activityDelete("Hapus {$this->log_name}", $user);
        return responseSuccess(BERHASIL_SIMPAN);
    }
}
