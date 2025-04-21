<?php

namespace App\Http\Controllers\Client;

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Pdf;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // نجيبو التصنيفات المتميزة و نحيدو لي فيهم قيم فارغة
        $categories = Pdf::select('category')->distinct()->pluck('category')->filter()->values();

        return view('client.categories.index', compact('categories'));
    }

    public function show($category)
    {
        // نفكو الترميز باش نرجعو الاسم الأصلي
        $category = urldecode($category);

        $pdfs = Pdf::where('category', $category)->paginate(4);
        return view('client.categories.show', compact('pdfs', 'category'));
    }

}
