<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pdf;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Auth::user()->favorites()->latest()->get();
        return view('client.favorites.index', compact('favorites'));
    }

    public function store(Pdf $pdf)
    {
        Auth::user()->favorites()->syncWithoutDetaching([$pdf->id]);
        return back()->with('success', 'تمت الإضافة إلى المفضلة');
    }

    public function destroy(Pdf $pdf)
    {
        Auth::user()->favorites()->detach($pdf->id);
        return back()->with('success', 'تم الحذف من المفضلة');
    }

    public function toggle(Pdf $pdf)
    {
        $user = Auth::user();

        if ($user->favorites->contains($pdf->id)) {
            $user->favorites()->detach($pdf->id);
        } else {
            $user->favorites()->attach($pdf->id);
        }

        return redirect()->back()->with('success', 'تم تحديث المفضلات بنجاح.');
    }

}
