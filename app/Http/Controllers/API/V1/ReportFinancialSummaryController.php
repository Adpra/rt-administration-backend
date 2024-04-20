<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\TransactionHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportFinancialSummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $monthlySummary = [];
        $totalBalance = 0;
    
        for ($i = 1; $i <= 12; $i++) {
            $incomeHistory = TransactionHistory::where('status', 1)
                ->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', $i)
                ->whereNotIn('type', ['PENGELUARAN'])
                ->sum('amount');
    
            $expenseHistory = TransactionHistory::where('status', 1)
                ->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', $i)
                ->whereIn('type', ['PENGELUARAN'])
                ->sum('amount');
    
            $currentBalance = $incomeHistory - $expenseHistory;
    
            $totalBalance += $currentBalance;
    
            $monthlySummary[] = [
                'month' => Carbon::create()->month($i)->format('F'),
                'income' => $incomeHistory,
                'expense' => $expenseHistory,
                'current_balance' => $currentBalance
            ];
        }
    
        return response()->json([
            'monthly_summary' => $monthlySummary,
            'total_balance' => $totalBalance
        ]);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
