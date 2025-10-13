<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromissoryNote;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // 1) Status counts
        $statusCounts = PromissoryNote::select('status', DB::raw('count(*) as cnt'))
            ->groupBy('status')
            ->pluck('cnt', 'status')
            ->toArray();

        // 1b) Total notes
        $totalNotes = PromissoryNote::count();

        // 2) Monthly (last 8 months)
        $start = Carbon::now()->subMonths(7)->startOfMonth();
        $monthsQuery = PromissoryNote::selectRaw("DATE_FORMAT(created_at, '%b %Y') as month_label, MIN(created_at) as min_date, COUNT(*) as cnt")
            ->where('created_at', '>=', $start)
            ->groupBy('month_label')
            ->orderBy('min_date')
            ->get();
        $monthlyLabels = $monthsQuery->pluck('month_label')->toArray();
        $monthlyData = $monthsQuery->pluck('cnt')->toArray();

        // 3) Per-semester / Per-academic-year counts
        $perSemester = PromissoryNote::select('semester', DB::raw('count(*) as cnt'))
            ->groupBy('semester')
            ->pluck('cnt', 'semester')
            ->toArray();

        $perAcademicYear = PromissoryNote::select('academic_year', DB::raw('count(*) as cnt'))
            ->groupBy('academic_year')
            ->orderBy('academic_year')
            ->pluck('cnt', 'academic_year')
            ->toArray();

        // 4) Department / Course / College / Year level / Gender
        $dept = PromissoryNote::select('department', DB::raw('count(*) as cnt'), DB::raw('COALESCE(SUM(amount),0) as total'))
            ->groupBy('department')
            ->get();
        $deptLabels = $dept->pluck('department')->toArray();
        $deptCounts = $dept->pluck('cnt')->toArray();
        $deptAmounts = $dept->pluck('total')->toArray();

        $courseCounts = PromissoryNote::select('course', DB::raw('count(*) as cnt'))
            ->groupBy('course')
            ->pluck('cnt', 'course')
            ->toArray();

        // college is stored on user — join users
        $collegeCounts = PromissoryNote::join('users', 'promissory_notes.user_id', '=', 'users.id')
            ->select('users.college', DB::raw('count(*) as cnt'))
            ->groupBy('users.college')
            ->pluck('cnt', 'college')
            ->toArray();

        $gender = PromissoryNote::select('gender', DB::raw('count(*) as cnt'))
            ->groupBy('gender')
            ->pluck('cnt', 'gender')
            ->toArray();

        $year = PromissoryNote::select('year_level', DB::raw('count(*) as cnt'))
            ->groupBy('year_level')
            ->pluck('cnt', 'year_level')
            ->toArray();

        // 5) Reason categories
        $reason = PromissoryNote::select('reason', DB::raw('count(*) as cnt'))
            ->groupBy('reason')
            ->pluck('cnt', 'reason')
            ->toArray();

        // 6) Amount distribution buckets
        $amountBuckets = PromissoryNote::selectRaw("
            CASE
                WHEN amount BETWEEN 0 AND 1000 THEN '0–1k'
                WHEN amount BETWEEN 1001 AND 5000 THEN '1k–5k'
                WHEN amount BETWEEN 5001 AND 10000 THEN '5k–10k'
                ELSE '10k+'
            END as bucket, COUNT(*) as cnt
        ")->groupBy('bucket')->pluck('cnt', 'bucket')->toArray();

        // 7) Downpayment / Payment compliance
        // Use is_settled OR compare down_payment against amount for fully paid detection
        $fullyPaid = PromissoryNote::where(function($q){
                $q->where('is_settled', true)
                  ->orWhereColumn('down_payment', '>=', 'amount');
            })->count();

        $partial = PromissoryNote::where(function($q){
                $q->whereNotNull('down_payment')
                  ->whereColumn('down_payment', '<', 'amount')
                  ->where('down_payment', '>', 0);
            })->count();

        $unpaid = PromissoryNote::where(function($q){
                $q->whereNull('down_payment')
                  ->orWhere('down_payment', 0);
            })->where(function($q){
                // exclude fully settled flagged rows
                $q->where('is_settled', false)->orWhereNull('is_settled');
            })->count();

        $avgDownPayment = PromissoryNote::whereNotNull('down_payment')->avg('down_payment') ?? 0;

        // 8) Overdue count (due_date < today and not settled)
        $overdue = PromissoryNote::whereNotNull('due_date')
            ->whereDate('due_date', '<', $today)
            ->where(function($q){ $q->where('is_settled', false)->orWhereNull('is_settled'); })
            ->count();

        // prepare payload
        $analyticsData = [
            'totalNotes' => $totalNotes,
            'statusCounts' => $statusCounts,
            'monthly' => ['labels' => $monthlyLabels, 'data' => $monthlyData],
            'perSemester' => $perSemester,
            'perAcademicYear' => $perAcademicYear,
            'department' => ['labels' => $deptLabels, 'counts' => $deptCounts, 'amounts' => $deptAmounts],
            'course' => $courseCounts,
            'college' => $collegeCounts,
            'gender' => $gender,
            'yearLevel' => $year,
            'reason' => $reason,
            'amountBuckets' => $amountBuckets,
            'payments' => [
                'fullyPaid' => $fullyPaid,
                'partial' => $partial,
                'unpaid' => $unpaid,
                'avgDownPayment' => (float)$avgDownPayment,
                'overdue' => $overdue,
            ],
        ];

        return view('admin.analytics', compact('analyticsData'));
    }
}
