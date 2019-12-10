<?php
namespace App\Http\Controllers;

use App\Billing;
use App\Customer;
use App\Employee;
use App\Zone;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Collection;

class DashboardController extends Controller
{
    public function index()
    {
        $employeesCount = Employee::count();
        $customersCount = Customer::count();
        $activeBillingCount = Customer::where('active', 1)->count();
        $arrears = Billing::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth())->sum('arrears');
        $revenue = Billing::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth())->sum('paid_amount');

        $groupedRevenue = Billing::select(
            DB::raw('MONTHNAME(payment_date) as month'),
            DB::raw('SUM(paid_amount) as monthlyRevenue'))
            ->groupBy('month')->orderBy('month', 'desc')->get()->toArray();

        $groupedDayRevenue = Billing::select(
            DB::raw('DATE(created_at) as day'),
            DB::raw('SUM(paid_amount) as monthlyRevenue'))
            ->whereMonth('created_at', Carbon::now()->month)
            ->groupBy('day')->orderBy('day', 'asc')->get()->toArray();

        $revenueMonths = collect($groupedRevenue)->pluck('month');
        $revenueMonthlyAmount = collect($groupedRevenue)->pluck('monthlyRevenue');

        $revenueDays = collect($groupedDayRevenue)->pluck('day');
        $revenueDaysAmount = collect($groupedDayRevenue)->pluck('monthlyRevenue');

        $days = [];
        foreach ($revenueDays as $day){
            $days[] = Carbon::parse($day)->format('M d');
        }

        $days = collect($days);

        // return response()->json($revenueDaysAmount);
        return view('admin.dashboard.finance')->with([
            'employeesCount' => $employeesCount,
            'customersCount' => $customersCount,
            'arrears' => $arrears,
            'revenue' => $revenue,
            'revenueMonths' => $revenueMonths,
            'revenueMonthlyAmount' => $revenueMonthlyAmount,
            'days' => $days,
            'revenueDaysAmount' => $revenueDaysAmount,
            'activeBillingCount' => $activeBillingCount

        ]);
    }

    public function basic() 
    {
         return view('admin.dashboard.basic');
    }

    public function ecommerce() 
    {
        return view('admin.dashboard.ecommerce');
    }

    public function finance() 
    {
        return view('admin.dashboard.finance');
    }
}
