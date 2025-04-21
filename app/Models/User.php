<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // علاقة Many-to-Many مع PDF (الـ PDF لي شراهم)
    public function purchasedPdfs()
    {
        return $this->belongsToMany(Pdf::class, 'purchases')
            ->withTimestamps();
    }

    // علاقة One-to-Many مع جدول المشتريات
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    public function favorites()
    {
        return $this->belongsToMany(Pdf::class, 'favorites')->withTimestamps();
    }

}
