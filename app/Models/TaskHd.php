<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskHd extends Model
{
    protected $table = "task_hd";
    protected $primaryKey = "id";
    protected $fillable = [
        "no_wo",
        "id_pemberi_tugas",
        "id_penerima_tugas",
        "deadline",
        "status",
        "waktu_mulai",
        "waktu_selesai"
    ];

    public function pemberi_tugas()
    {
        return $this->hasOne(User::class, "id", "id_pemberi_tugas");
    }

    public function penerima_tugas()
    {
        return $this->hasOne(User::class, "id", "id_penerima_tugas");
    }

    public function task_dt()
    {
        return $this->hasMany(TaskDt::class, "id_task_hd", "id");
    }
}
