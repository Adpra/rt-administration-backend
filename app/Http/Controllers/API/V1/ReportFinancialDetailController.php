<?php

namespace App\Http\Controllers\API\v1;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\TransactionHistoryResource;
use App\Models\TransactionHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReportFinancialDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', TransactionHistory::class);
        

        $code = Response::HTTP_OK;
        $success = true;
        $message = __('messages.data_list');
        $perPage = $request->per_page ?? 15;
        $page = $request->page ?? 1;

        $user = auth('api')->user();

        try {
            $month = $request->has('month') ? $request->month : Carbon::now()->month;

            $transactionHistories = TransactionHistory::query()
            ->where('status', StatusEnum::LUNAS)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', $month)
             ->latest('created_at');

            $transactionHistories = $transactionHistories->paginate($perPage, ['*'], 'page', $page);

            return TransactionHistoryResource::collection($transactionHistories)
                ->additional(
                    [
                        'code' => $code,
                        'success' => $success,
                        'message' => $message,
                    ]
                );
        } catch (\Throwable $th) {
            $code = Response::HTTP_INTERNAL_SERVER_ERROR;

            return response()->json(
                [
                    'code' => $code,
                    'success' => false,
                    'message' => $th->getMessage(),
                ],
                $code
            );
        }
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
