<?php

namespace App\Http\Controllers;

use App\Models\TaskDt;
use App\Models\TaskHd;
use App\Models\TaskProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TugasDetailController extends BaseController
{
    protected $view = "app.tugas-detail";
    protected $permission_name = "tugas";
    protected $log_name = "Tugas Detail";

    public function edit($id)
    {
        notAjaxAbort();
        $id = decode($id);
        $task = TaskDt::findOrFail($id);
        $details = [
            [
                "Produk" => $task->produk->nama_produk,
                "Kode Produk" => $task->produk->kode_produk,
            ],
            [
                "Jumlah" => $task->jumlah,
                "Status" => statusTask($task->status),
            ]
        ];
        return view($this->view . ".edit", compact("task", "details"));
    }

    public function update(Request $request, $id)
    {
        notAjaxAbort();
        $id = decode($id);
        $task = TaskDt::findOrFail($id);
        $task_hd = TaskHd::findOrFail($task->id_task_hd);
        $validator = Validator::make(
            $request->all(),
            [
                "note" => "required|string|max:50",
                "jumlah" => "required|numeric|min:1",
            ],
            [],
            [
                "note" => "Note",
                "jumlah" => "Jumlah",
            ]
        );
        $attributes = $validator->validated();
        DB::beginTransaction();
        try {
            $task_data['status'] = nextStatusTask($task->status);
            if ($task_data['status'] == TASK_STATUS_IN_PROGRESS) {
                $task_data['waktu_mulai'] = now();
                $task_data['jumlah_real'] = $attributes['jumlah'];
            } else {
                $task_data['waktu_selesai'] = now();
                $task_data['jumlah_real'] = $attributes['jumlah'] + $task->jumlah_real;
            }
            $update = $task->update($task_data);
            // insert to note
            TaskProgress::create([
                "id_task_dt" => $task->id,
                "note" => $attributes['note'],
                "status" => $task_data['status'],
                "jumlah" => $attributes['jumlah']
            ]);
            // update task head
            $task_hd_data = [];
            if ($task_hd->status == TASK_STATUS_PENDING) {
                $task_hd_data['status'] = TASK_STATUS_IN_PROGRESS;
                $task_hd_data['waktu_mulai'] = now();
            } else {
                // check other sub task
                $check = TaskDt::where("id_task_hd", $task_hd->id)
                    ->where("id", "!=", $id)
                    ->where("status", "!=", TASK_STATUS_COMPLETED)
                    ->count();
                if ($check < 1) {
                    $task_hd_data['status'] = TASK_STATUS_COMPLETED;
                    $task_hd_data['waktu_selesai'] = now();
                }
            }
            if (!empty($task_hd_data))
                $task_hd->update($task_hd_data);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = env("APP_DEBUG") ? $e->getMessage() : GAGAL_SIMPAN;
            return responseFail($message);
        }
        DB::commit();
        $this->activityUpdate("Ubah {$this->log_name}", $task, json_encode([
            "task_note" => $attributes,
            "task_dt" => $task_data,
            "task_hd" => $task

        ]));
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
}
