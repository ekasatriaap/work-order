<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenugasanDetailRequest;
use App\Models\Produk;
use App\Models\TaskDt;
use App\Models\TaskHd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenugasanDetailController extends BaseController
{
    protected $view = "app.penugasan-detail";
    protected $permission_name = "penugasan-detail";
    protected $log_name = "penugasan detail";

    public function create(Request $request)
    {
        notAjaxAbort();
        $id = $request->id;
        $produks = Produk::pluck("nama_produk", "id");
        $task_dt = new TaskDt();
        return view("{$this->view}.create", compact("id", "produks", "task_dt"));
    }


    public function store(PenugasanDetailRequest $request)
    {
        notAjaxAbort();
        $attributes = $request->validated();
        $id_task_hd = decode(request()->id_task_hd);
        $task_hd = TaskHd::find($id_task_hd);
        if (empty($task_hd)) {
            return responseFail("Penugasan tidak ditemukan");
        }
        DB::beginTransaction();
        try {
            $attributes["id_task_hd"] = $id_task_hd;
            $attributes['status'] = TASK_STATUS_PENDING;
            TaskDt::create($attributes);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = env("APP_DEBUG") ? $e->getMessage() : GAGAL_SIMPAN;
            return responseFail($message);
        }
        DB::commit();
        $this->activityCreate("Tambah {$this->log_name}", $task_hd);
        return responseSuccess(BERHASIL_SIMPAN);
    }

    public function edit($id)
    {
        notAjaxAbort();
        $id = decode($id);
        $task_dt = TaskDt::findOrFail($id);
        $produks = Produk::pluck("nama_produk", "id");
        return view("{$this->view}.edit", compact("task_dt", "produks"));
    }

    public function update(PenugasanDetailRequest $request, $id)
    {
        notAjaxAbort();
        $attributes = $request->validated();
        $id = decode($id);
        $task_dt = TaskDt::findOrFail($id);
        DB::beginTransaction();
        try {
            $task_dt->update($attributes);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = env("APP_DEBUG") ? $e->getMessage() : GAGAL_SIMPAN;
            return responseFail($message);
        }
        DB::commit();
        $this->activityUpdate("Ubah {$this->log_name}", $task_dt, $task_dt->getChanges());
        return responseSuccess(BERHASIL_SIMPAN);
    }

    public function show($id)
    {
        notAjaxAbort();
        $id = decode($id);
        $task_dt = TaskDt::with(["produk", "progress"])->findOrFail($id);
        $data = [
            [
                "Produk" => $task_dt->produk->nama_produk,
                "Status" => TASK_STATUS[$task_dt->status]
            ],
            [
                "Jumlah" => $task_dt->jumlah,
                "Jumlah Realisasi" => $task_dt->jumlah_real,
            ]
        ];
        return view("{$this->view}.show", compact("task_dt", "data"));
    }

    public function destroy($id)
    {
        notAjaxAbort();
        $id = decode($id);
        $task_dt = TaskDt::findOrFail($id);
        DB::beginTransaction();
        try {
            $task_dt->delete();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = env("APP_DEBUG") ? $e->getMessage() : GAGAL_HAPUS;
            return responseFail($message);
        }
        DB::commit();
        $this->activityDelete("Hapus {$this->log_name}", $task_dt);
        return responseSuccess(BERHASIL_HAPUS);
    }
}
