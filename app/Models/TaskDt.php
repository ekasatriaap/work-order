<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskDt extends Model
{
    protected $table = "task_dt";
    protected $primaryKey = "id";
    protected $fillable = [
        "id_task_hd",
        "id_produk",
        "jumlah",
        "jumlah_real",
        "waktu_mulai",
        "waktu_selesai",
        "status"
    ];

    public function produk()
    {
        return $this->hasOne(Produk::class, "id", "id_produk");
    }

    public function progress()
    {
        return $this->hasMany(TaskProgress::class, "id_task_dt", "id");
    }
}
