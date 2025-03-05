<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id_user', 'id_role'];

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'id_role');
    }
}
