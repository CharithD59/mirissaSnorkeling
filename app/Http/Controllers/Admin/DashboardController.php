<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\ContactInquiry;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends AdminController
{
    public function index()
    {
        $statusCounts = Booking::query()
            ->select(DB::raw("COALESCE(status, 'pending') as status_key"), DB::raw('COUNT(*) as total'))
            ->groupBy('status_key')
            ->pluck('total', 'status_key')
            ->all();

        $inquiryCounts = ContactInquiry::query()
            ->select(DB::raw("COALESCE(status, 'pending') as status_key"), DB::raw('COUNT(*) as total'))
            ->groupBy('status_key')
            ->pluck('total', 'status_key')
            ->all();

        $today = Carbon::today();

        $stats = [
            'bookings_total'     => array_sum($statusCounts),
            'bookings_pending'   => isset($statusCounts['pending']) ? $statusCounts['pending'] : 0,
            'bookings_confirmed' => isset($statusCounts['confirmed']) ? $statusCounts['confirmed'] : 0,
            'bookings_completed' => isset($statusCounts['completed']) ? $statusCounts['completed'] : 0,
            'bookings_cancelled' => isset($statusCounts['cancelled']) ? $statusCounts['cancelled'] : 0,
            'inquiries_total'    => array_sum($inquiryCounts),
            'inquiries_pending'  => isset($inquiryCounts['pending']) ? $inquiryCounts['pending'] : 0,
            'inquiries_replied'  => isset($inquiryCounts['replied']) ? $inquiryCounts['replied'] : 0,
            'packages_active'    => Package::active()->count(),
            'packages_total'     => Package::count(),
            'bookings_today'     => Booking::whereDate('cre_datetime', $today)->count(),
            'bookings_this_month'=> Booking::where('cre_datetime', '>=', $today->copy()->startOfMonth())->count(),
            'bookings_last_month'=> Booking::whereBetween('cre_datetime', [
                $today->copy()->subMonthNoOverflow()->startOfMonth(), $today->copy()->startOfMonth(),
            ])->count(),
            'guests_upcoming'    => 0,
            'revenue_confirmed'  => (float) Booking::whereIn('status', ['confirmed', 'completed'])->sum('total_amount'),
            'whatsapp_clicks'    => 0,
        ];

        if (Schema::hasTable('whatsapp_click_logs')) {
            $stats['whatsapp_clicks'] = DB::table('whatsapp_click_logs')
                ->where('created_at', '>=', $today->copy()->subDays(30))
                ->count();
        }

        // Upcoming tours (next 14 days, not cancelled)
        $upcoming = Booking::query()
            ->whereRaw('DATE(`datetime`) >= ?', [$today->toDateString()])
            ->whereRaw('DATE(`datetime`) <= ?', [$today->copy()->addDays(14)->toDateString()])
            ->where(function ($q) {
                $q->whereNull('status')->orWhere('status', '!=', 'cancelled');
            })
            ->orderByRaw('DATE(`datetime`) asc')
            ->limit(8)
            ->get();
        $stats['guests_upcoming'] = $upcoming->sum(function ($b) {
            return $b->guest_count;
        });

        // Bookings & inquiries per month (last 12 months)
        $start = $today->copy()->startOfMonth()->subMonths(11);
        $bookingMonthly = Booking::query()
            ->where('cre_datetime', '>=', $start)
            ->select(DB::raw("DATE_FORMAT(cre_datetime, '%Y-%m') as ym"), DB::raw('COUNT(*) as total'))
            ->groupBy('ym')->pluck('total', 'ym')->all();
        $inquiryMonthly = ContactInquiry::query()
            ->where('cre_datetime', '>=', $start)
            ->select(DB::raw("DATE_FORMAT(cre_datetime, '%Y-%m') as ym"), DB::raw('COUNT(*) as total'))
            ->groupBy('ym')->pluck('total', 'ym')->all();

        $chart = ['labels' => [], 'bookings' => [], 'inquiries' => []];
        for ($i = 0; $i < 12; $i++) {
            $month = $start->copy()->addMonths($i);
            $key = $month->format('Y-m');
            $chart['labels'][] = $month->format('M Y');
            $chart['bookings'][] = isset($bookingMonthly[$key]) ? (int) $bookingMonthly[$key] : 0;
            $chart['inquiries'][] = isset($inquiryMonthly[$key]) ? (int) $inquiryMonthly[$key] : 0;
        }

        // Daily series for the last 30 days (sparklines + "30 days" chart range)
        $dayStart = $today->copy()->subDays(29);
        $bookingDaily = Booking::query()
            ->where('cre_datetime', '>=', $dayStart)
            ->select(DB::raw('DATE(cre_datetime) as d'), DB::raw('COUNT(*) as total'))
            ->groupBy('d')->pluck('total', 'd')->all();
        $inquiryDaily = ContactInquiry::query()
            ->where('cre_datetime', '>=', $dayStart)
            ->select(DB::raw('DATE(cre_datetime) as d'), DB::raw('COUNT(*) as total'))
            ->groupBy('d')->pluck('total', 'd')->all();
        $daily = ['labels' => [], 'bookings' => [], 'inquiries' => []];
        for ($i = 0; $i < 30; $i++) {
            $day = $dayStart->copy()->addDays($i);
            $key = $day->toDateString();
            $daily['labels'][] = $day->format('d M');
            $daily['bookings'][] = isset($bookingDaily[$key]) ? (int) $bookingDaily[$key] : 0;
            $daily['inquiries'][] = isset($inquiryDaily[$key]) ? (int) $inquiryDaily[$key] : 0;
        }

        // Guests per tour day for the next 14 days (non-cancelled)
        $demand = ['labels' => [], 'guests' => []];
        $demandRows = Booking::query()
            ->whereRaw('DATE(`datetime`) >= ?', [$today->toDateString()])
            ->whereRaw('DATE(`datetime`) < ?', [$today->copy()->addDays(14)->toDateString()])
            ->where(function ($q) {
                $q->whereNull('status')->orWhere('status', '!=', 'cancelled');
            })->get();
        $byDay = [];
        foreach ($demandRows as $row) {
            if ($row->tour_date) {
                $k = $row->tour_date->toDateString();
                $byDay[$k] = (isset($byDay[$k]) ? $byDay[$k] : 0) + $row->guest_count;
            }
        }
        for ($i = 0; $i < 14; $i++) {
            $day = $today->copy()->addDays($i);
            $demand['labels'][] = $i === 0 ? 'Today' : $day->format('D d');
            $demand['guests'][] = isset($byDay[$day->toDateString()]) ? $byDay[$day->toDateString()] : 0;
        }

        $decided = $stats['bookings_total'] - $stats['bookings_pending'];
        $stats['confirmation_rate'] = $decided > 0
            ? round(($stats['bookings_confirmed'] + $stats['bookings_completed']) / $decided * 100)
            : null;
        $stats['response_rate'] = $stats['inquiries_total'] > 0
            ? round(($stats['inquiries_total'] - $stats['inquiries_pending']) / $stats['inquiries_total'] * 100)
            : null;
        $oldestPending = Booking::where(function ($q) {
            $q->where('status', 'pending')->orWhereNull('status');
        })->orderBy('cre_datetime')->value('cre_datetime');
        $stats['oldest_pending'] = $oldestPending ? Carbon::parse($oldestPending) : null;
        $stats['inquiries_this_month'] = ContactInquiry::where('cre_datetime', '>=', $today->copy()->startOfMonth())->count();
        $stats['inquiries_last_month'] = ContactInquiry::whereBetween('cre_datetime', [
            $today->copy()->subMonthNoOverflow()->startOfMonth(), $today->copy()->startOfMonth(),
        ])->count();

        $popular = Booking::query()
            ->select('service_name', DB::raw('COUNT(*) as total'))
            ->whereNotNull('service_name')
            ->groupBy('service_name')
            ->orderByDesc('total')
            ->limit(6)
            ->get();

        $statusChart = [];
        foreach (Booking::STATUSES as $key => $label) {
            $statusChart[] = ['label' => $label, 'value' => isset($statusCounts[$key]) ? (int) $statusCounts[$key] : 0, 'key' => $key];
        }

        $recentBookings = Booking::query()->orderByDesc('cre_datetime')->limit(7)->get();
        $recentInquiries = ContactInquiry::query()->orderByDesc('cre_datetime')->limit(5)->get();

        return view('admin.dashboard', compact(
            'stats', 'chart', 'daily', 'demand', 'popular', 'statusChart', 'recentBookings', 'recentInquiries', 'upcoming'
        ));
    }
}
