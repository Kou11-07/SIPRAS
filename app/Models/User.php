<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nisn',
        'username',
        'tanggal_lahir',
        'password',
        'email',
        'phone',
        'kelas',
        'is_active',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'is_active' => 'boolean',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // Harusnya ada relasi seperti ini:
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isActive()
    {
        return $this->is_active;
    }

    // Method untuk cek login admin
    public static function authenticateAdmin($username, $password)
    {
        $user = self::where('username', $username)
            ->where('role', 'admin')
            ->first();

        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }

        return null;
    }

    // Method untuk cek login user
    public static function authenticateUser($nisn, $tanggal_lahir)
    {
        $user = self::where('nisn', $nisn)
            ->where('role', 'user')
            ->first();

        if ($user && $user->tanggal_lahir->format('Y-m-d') === $tanggal_lahir) {
            return $user;
        }

        return null;
    }
}
