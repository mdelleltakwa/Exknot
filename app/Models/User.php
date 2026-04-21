<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role',
        'company_name', 'country', 'bio', 'avatar',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin(): bool { return $this->role === 'admin'; }
    public function isFirm(): bool  { return $this->role === 'firm'; }
    public function isClient(): bool { return $this->role === 'client'; }

    public function products() { return $this->hasMany(Product::class); }
    public function orders()   { return $this->hasMany(Order::class); }
    public function reviews()  { return $this->hasMany(Review::class); }
}
