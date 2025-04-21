<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['user_id', 'pdf_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pdf()
    {
        return $this->belongsTo(Pdf::class);
    }
}
