<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pdf;
use App\Models\Visitor;
use App\Models\Download;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // عدد المستخدمين
        $usersCount = User::count();

        // عدد ملفات PDF
        $pdfsCount = Pdf::count();

        // أحدث المستخدمين (آخر ساعة)
        $recentUsers = User::where('created_at', '>=', now()->subHour())->latest()->take(5)->get();

        // أحدث ملفات PDF (آخر ساعة)
        $recentPDFs = Pdf::where('created_at', '>=', now()->subHour())->latest()->take(5)->get();

        // عدد الزوار المختلفين خلال 24 ساعة
        $visitorsCount = Visitor::where('created_at', '>=', now()->subDay())->distinct('ip')->count('ip');

        // عدد المستخدمين خلال آخر 7 أيام (للمبيان)
        $usersPerDay = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupByRaw('DATE(created_at)')
            ->orderBy('date')
            ->get();

        // إعداد بيانات المبيان للمستخدمين
        $userStats = [
            'labels' => $usersPerDay->pluck('date')->map(function ($date) {
                return Carbon::parse($date)->translatedFormat('l'); // اسم اليوم
            })->toArray(),
            'data' => $usersPerDay->pluck('count')->toArray(),
        ];

        // عدد التحميلات الكلي
        $totalDownloads = Download::count();

        // أكثر ملف PDF تحميلاً
        $mostDownloadedPDF = Pdf::withCount('downloads')
            ->orderByDesc('downloads_count')
            ->first();

        // آخر التحميلات
        $latestDownloads = Download::with(['user', 'pdf'])
            ->latest()
            ->take(10)
            ->get();

        // عدد التحميلات لكل يوم خلال آخر 30 يوم
        $downloadsPerDay = Download::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(29)->startOfDay())
            ->groupByRaw('DATE(created_at)')
            ->orderBy('date')
            ->get();

        // إعداد بيانات المبيان للتحميلات
        $downloadsStats = [
            'labels' => $downloadsPerDay->pluck('date')->map(function ($date) {
                return Carbon::parse($date)->translatedFormat('d M'); // يوم وشهر
            })->toArray(),
            'data' => $downloadsPerDay->pluck('count')->toArray(),
        ];

        // إرسال البيانات للواجهة
        return view('admin.dashboard', compact(
            'usersCount',
            'pdfsCount',
            'recentUsers',
            'recentPDFs',
            'visitorsCount',
            'userStats',
            'downloadsStats',
            'totalDownloads',
            'mostDownloadedPDF',
            'latestDownloads'
        ));
    }
}
