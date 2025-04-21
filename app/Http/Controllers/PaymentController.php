<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pdf;
use App\Models\Purchase;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function checkout(Pdf $pdf)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'mad',
                    'product_data' => [
                        'name' => $pdf->title,
                    ],
                    'unit_amount' => $pdf->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', $pdf->id),
            'cancel_url' => route('pdfs.show', $pdf->id),
            'customer_email' => Auth::user()->email, // ✅ هادي جديدة باش نمنعو sharing
            'metadata' => [
                'user_id' => Auth::id(),
                'pdf_id' => $pdf->id,
            ],
        ]);


        return redirect($session->url);
    }



    public function success(Pdf $pdf)
{
    $userId = auth()->id();

    // سجل الشراء مرة وحدة فقط
    $alreadyPurchased = Purchase::where('user_id', $userId)
        ->where('pdf_id', $pdf->id)
        ->exists();

    if (! $alreadyPurchased) {
        Purchase::create([
            'user_id' => $userId,
            'pdf_id' => $pdf->id,
        ]);
    }

    return view('payment.success', compact('pdf'));
}


}
