<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = ['user_id', 'pdf_id'];

    public function pdf()
    {
        return $this->belongsTo(Pdf::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
