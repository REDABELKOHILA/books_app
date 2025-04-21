<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Request;
use App\Models\Visitor;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        if (!request()->is('admin/*')) {
            Visitor::create([
                'ip' => Request::ip()
            ]);
        }
    }
}
