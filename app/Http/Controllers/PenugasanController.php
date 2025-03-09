<?php

namespace App\Http\Controllers;

use App\DataTables\PenugasanDtDataTable;
use App\DataTables\PenugasanHdDataTable;
use App\Http\Requests\PenugasanRequest;
use App\Models\TaskDt;
use App\Models\TaskHd;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PenugasanController extends BaseController
{
    protected $view = "app.penugasan";
    protected $permission_name = "penugasan";
    protected $log_name = "penugasan";

    public function index(PenugasanHdDataTable $dataTable)
    {
        $title = "Penugasan";
        $status = collect(TASK_STATUS);
        $param = [
            "id" => auth()->user()->id,
            "is_root" => auth()->user()->is_root
        ];
        return $dataTable->setPermission($this->permission_name)
            ->setButton("{$this->view}.button")
            ->setParam($param)
            ->render($this->view . ".index", compact("title", "status"));
    }

    public function create()
    {
        $data = [
            "title" => "Tambah Penugasan",
            "penerima_tugas" => User::usersRole()->pluck("user_role", "id"),
            "penugasan" => new TaskHd(),
            "status" => TASK_STATUS,
        ];
        return view($this->view . ".create", $data);
    }

    public function store(PenugasanRequest $request)
    {
        $attributes = $request->validated();
        DB::beginTransaction();
        try {
            $attributes['id_pemberi_tugas'] = auth()->user()->id;
            $attributes['status'] = TASK_STATUS_PENDING;
            $attributes['no_wo'] = $this->generateNoWo();
            $store = TaskHd::create($attributes);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = env("APP_DEBUG") ? $e->getMessage() : GAGAL_SIMPAN;
            return redirect()->back()->with("sweet_error", $message);
        }
        DB::commit();
        $this->activityCreate("Tambah {$this->log_name}", $store);
        return redirect()->route("penugasan.edit", encode($store->id))->with("sweet_success", BERHASIL_SIMPAN);
    }

    private function generateNoWo()
    {
        $getTugas = TaskHd::where("created_at", "like", date("Y-m-d") . "%")->count();
        $no_tugas = str_pad($getTugas + 1, 3, "0", STR_PAD_LEFT);
        return "WO-" . date("Ymd") . "-" . $no_tugas;
    }
    public function edit(PenugasanDtDataTable $dataTable, $id)
    {
        $id = decode($id);
        $penugasan = TaskHd::findOrFail($id);
        $data = [
            "title" => $penugasan->no_wo,
            "penerima_tugas" => User::usersRole()->pluck("user_role", "id"),
            "penugasan" => $penugasan,
            "status" => TASK_STATUS,
        ];
        return $dataTable->setPermission($this->permission_name)
            ->setButton("{$this->view}-detail.button")
            ->setParam(["id_task_hd" => $id])
            ->render($this->view . ".edit", $data);
    }

    public function update(PenugasanRequest $request, $id)
    {
        $id = decode($id);
        $attributes = $request->validated();
        DB::beginTransaction();
        try {
            $update = TaskHd::findOrFail($id);
            $update->update($attributes);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = env("APP_DEBUG") ? $e->getMessage() : GAGAL_SIMPAN;
            return redirect()->back()->with("sweet_error", $message);
        }
        DB::commit();
        $this->activityUpdate("Update {$this->log_name}", $update, $update->getChanges());
        return redirect()->route("penugasan.edit", encode($update->id))->with("sweet_success", BERHASIL_SIMPAN);
    }

    public function show($id)
    {
        notAjaxAbort();
        $id = decode($id);
        $penugasan = TaskHd::with(["task_dt.progress", 'pemberi_tugas', 'penerima_tugas'])->findOrFail($id);
        $detail = [
            [
                "No WO" => $penugasan->no_wo,
            ],
            [
                "Pemberi Tugas" => $penugasan->pemberi_tugas->name,
                "Penerima Tugas" => $penugasan->penerima_tugas->name,
            ],
            [
                "Status" => statusTask($penugasan->status),
                "Tenggat Waktu" => tanggal($penugasan->deadline, "d F Y H:i"),
            ]
        ];

        if ($penugasan->status == TASK_STATUS_COMPLETED) {
            $start = Carbon::parse($penugasan->waktu_mulai);
            $end = Carbon::parse($penugasan->waktu_selesai);
            $lamaPengerjaan = $start->diffInHours($end);
            $detail[0]["Lama Pengerjaan"] = round($lamaPengerjaan, 2) . " Jam";
        }

        return view("{$this->view}.show", compact("penugasan", "detail"));
    }

    public function destroy($id)
    {
        notAjaxAbort();
        $id = decode($id);
        $penugasan = TaskHd::findOrFail($id);
        DB::beginTransaction();
        try {
            $penugasan->update([
                "status" => TASK_STATUS_CANCELED
            ]);
            // update child
            TaskDt::where("id_task_hd", $id)->update([
                "status" => TASK_STATUS_CANCELED
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = env("APP_DEBUG") ? $e->getMessage() : GAGAL_HAPUS;
            return responseFail($message);
        }
        DB::commit();
        $this->activityUpdate("Hapus {$this->log_name}", $penugasan, $penugasan->getChanges());
        return responseSuccess(BERHASIL_HAPUS);
    }
}
