<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peran extends Model
{
    protected $table = 'peran';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_peran', "level"];
}
