<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskProgress extends Model
{
    protected $table = 'task_progress';
    protected $primaryKey = 'id';
    protected $fillable = [
        "id_task_dt",
        "note",
        "jumlah",
        "status"
    ];
}
