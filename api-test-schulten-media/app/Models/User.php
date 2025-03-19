<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Filament\Panel;

class User extends Authenticatable implements JWTSubject, FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'rol'];
    protected $hidden = ['password'];

    
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->rol === 'admin';
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
