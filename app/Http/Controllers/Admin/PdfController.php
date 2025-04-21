<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function index()
    {
        $pdfs = Pdf::latest()->paginate(3);
        return view('admin.pdfs.index', compact('pdfs'));
    }

    public function create()
    {
        return view('admin.pdfs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|mimes:pdf|max:10240', // 10MB
            'image' => 'nullable|image|max:2048',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:255',
        ]);

        $filePath = $request->file('file')->store('pdfs', 'public');

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pdf_images', 'public');
        }

        Pdf::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'file_path' => $filePath,
            'image_path' => $imagePath,
            'price' => $validated['price'],
            'category' => $validated['category'] ?? null,
        ]);

        return redirect()->route('admin.pdfs.index')->with('success', 'تمت إضافة الكتاب بنجاح');
    }

    public function edit(Pdf $pdf)
    {
        return view('admin.pdfs.edit', compact('pdf'));
    }

    public function update(Request $request, Pdf $pdf)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|mimes:pdf|max:10240',
            'image' => 'nullable|image|max:2048',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('file')) {
            if ($pdf->file_path && Storage::disk('public')->exists($pdf->file_path)) {
                Storage::disk('public')->delete($pdf->file_path);
            }
            $pdf->file_path = $request->file('file')->store('pdfs', 'public');
        }

        if ($request->hasFile('image')) {
            if ($pdf->image_path && Storage::disk('public')->exists($pdf->image_path)) {
                Storage::disk('public')->delete($pdf->image_path);
            }
            $pdf->image_path = $request->file('image')->store('pdf_images', 'public');
        }

        $pdf->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'category' => $validated['category'] ?? null,
        ]);

        return redirect()->route('admin.pdfs.index')->with('success', 'تم تحديث الكتاب بنجاح');
    }

    public function destroy(Pdf $pdf)
    {
        if ($pdf->file_path && Storage::disk('public')->exists($pdf->file_path)) {
            Storage::disk('public')->delete($pdf->file_path);
        }

        if ($pdf->image_path && Storage::disk('public')->exists($pdf->image_path)) {
            Storage::disk('public')->delete($pdf->image_path);
        }

        $pdf->delete();

        return redirect()->route('admin.pdfs.index')->with('success', 'تم حذف الكتاب بنجاح');
    }
}
