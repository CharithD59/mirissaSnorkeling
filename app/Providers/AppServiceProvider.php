<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Website content & admin helper functions (setting(), site_asset(), ...)
        require_once app_path('Support/helpers.php');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Keeps unique indexes within the limit of older MySQL / MariaDB versions.
        Schema::defaultStringLength(191);

        Paginator::useBootstrap();

        // Counters shown in the admin sidebar / notification bell.
        View::composer('admin.layouts.app', function ($view) {
            $pendingBookings = \App\Models\Booking::where(function ($q) {
                $q->where('status', 'pending')->orWhereNull('status');
            })->count();
            $newInquiries = \App\Models\ContactInquiry::where(function ($q) {
                $q->where('status', 'pending')->orWhereNull('status');
            })->orderByDesc('cre_datetime')->limit(5)->get();
            $pendingInquiries = \App\Models\ContactInquiry::where(function ($q) {
                $q->where('status', 'pending')->orWhereNull('status');
            })->count();

            $view->with(compact('pendingBookings', 'newInquiries', 'pendingInquiries'));
        });
    }
}
