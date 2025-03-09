<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        "username",
        "id_role",
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->hasOne(Role::class, "id", "id_role");
    }

    public static function usersRole()
    {
        $is_root = auth()->user()->is_root;
        $level = auth()->user()->role?->level ?? 0;
        return User::selectRaw("users.*, CONCAT(users.name, ' .::. ', roles.name) AS user_role")
            ->join("roles", "roles.id", "=", "users.id_role")
            ->when(!$is_root, fn($query) => $query->where("roles.level", ">", $level))
            ->get();
    }
}
