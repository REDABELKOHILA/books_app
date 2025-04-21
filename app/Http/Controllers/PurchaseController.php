<?php
namespace App\Http\Controllers;

use App\Models\Pdf;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function store(Pdf $pdf)
    {
        $user = auth()->user();

        if (!$user->purchasedPdfs->contains($pdf->id)) {
            $user->purchasedPdfs()->attach($pdf->id);
        }

        return redirect()->back()->with('success', 'تم الشراء بنجاح! يمكنك الآن تحميل الملف.');
    }
}


