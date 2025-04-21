<?php

// app/Http/Controllers/Client/DownloadController.php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = auth()->user()->purchasedPdfs;
        return view('client.downloads.index', compact('downloads'));
    }
}

