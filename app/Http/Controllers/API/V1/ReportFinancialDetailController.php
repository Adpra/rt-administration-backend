<?php

namespace App\Http\Controllers\API\v1;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\TransactionHistoryResource;
use App\Models\TransactionHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportFinancialDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $month = $request->has('month') ? $request->month : Carbon::now()->month;
    
        $incomeHistory = TransactionHistory::where('status', StatusEnum::LUNAS)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', $month)
            ->whereNotIn('type', ['PENGELUARAN'])
            ->get();
    
        $expenseHistory = TransactionHistory::where('status', StatusEnum::LUNAS)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', $month)
            ->whereIn('type', ['PENGELUARAN'])
            ->get();
    
        return response()->json([
            'income_history' => TransactionHistoryResource::collection($incomeHistory),
            'expense_history' => TransactionHistoryResource::collection($expenseHistory),
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
