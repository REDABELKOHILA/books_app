<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pdf extends Model
{
    // protected $fillable = [
    //     'title',
    //     'description',
    //     'file_path',
    //     'image_path',
    //     'price',
    // ];
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'image_path',
        'price',
        'category', // 👈
    ];


    // علاقة Many-to-Many مع المستخدمين
    public function buyers()
    {
        return $this->belongsToMany(User::class, 'purchases')
            ->withTimestamps();
    }

    // علاقة One-to-Many مع جدول المشتريات
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function downloads()
    {
        return $this->hasMany(\App\Models\Download::class);
    }
    public function favoredBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

}
