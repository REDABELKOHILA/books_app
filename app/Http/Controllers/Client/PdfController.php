<?php

namespace App\Http\Controllers\Client;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pdf;
use App\Models\Download; // ✅ هذا هو السطر الناقص

class PdfController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // ✅ Autocomplete suggestions (AJAX)
        if ($request->ajax()) {
            $results = Pdf::where('title', 'like', '%' . $query . '%')
                ->limit(5)
                ->pluck('title');

            return response()->json($results);
        }

        // ✅ Full search page
        $pdfs = Pdf::where('title', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->get();

        return view('client.search_results', compact('pdfs', 'query'));
    }

    public function download(Pdf $pdf)
    {
        $user = auth()->user();

        // تحقق واش شرا هاد الـ PDF
        if (!$user->purchasedPdfs->contains($pdf->id)) {
            abort(403, 'ماعندكش الحق لتحميل هاد الملف.');
        }

        // ✅ نسجلو التحميل
        Download::create([
            'user_id' => $user->id,
            'pdf_id' => $pdf->id,
        ]);

        $filePath = $pdf->file_path;

        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'الملف غير موجود');
        }

        return Storage::disk('public')->download($filePath, $pdf->title . '.pdf');
    }
}
