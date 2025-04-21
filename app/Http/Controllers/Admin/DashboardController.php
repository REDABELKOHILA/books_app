<?php
// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        $pdfCount = Pdf::count();
        $userCount = User::where('role', 'client')->count(); // نحسب غير الكليان

        return view('admin.dashboard', compact('pdfCount', 'userCount'));
    }

//     public function dashboard()
// {
//     $userStats = [
//         'labels' => ['سبت', 'أحد', 'اثنين', 'ثلاثاء', 'أربعاء', 'خميس', 'جمعة'],
//         'data' => [3, 6, 4, 5, 7, 2, 1]
//     ];

//     $downloadsStats = [
//         'labels' => ['مارس', 'أبريل', 'ماي'],
//         'data' => [20, 40, 35]
//     ];

//     return view('admin.dashboard', [
//         'userStats' => $userStats,
//         'downloadsStats' => $downloadsStats,
//         'usersCount' => 100,
//         'pdfsCount' => 50,
//         'visitorsCount' => 120,
//         'recentUsers' => collect([]),
//         'recentPDFs' => collect([]),
//         'mostDownloadedPDF' => null,
//     ]);
// }

}
