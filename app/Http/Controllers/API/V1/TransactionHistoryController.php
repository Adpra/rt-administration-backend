<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\TransactionHistoryRequest;
use App\Http\Resources\v1\TransactionHistoryResource;
use App\Models\TransactionHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class TransactionHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $code = Response::HTTP_OK;
        $success = true;
        $message = __('messages.data_list');
        $perPage = $request->per_page ?? 15;
        $page = $request->page ?? 1;

        $user = auth('api')->user();

        try {
            $user = auth('api')->user();

            $transactionHistories = TransactionHistory::query()
                ->latest('created_at');

            if ($user && !$user->is_admin) {
                $transactionHistories = $transactionHistories->where('house_id', $user->house->id);
            }

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
    public function store(TransactionHistoryRequest $request)
    {
        $code = Response::HTTP_CREATED;
        $success = true;
        $message = __('messages.data_saved');
        $user = auth('api')->user();

        try {
            $transactionHistory = TransactionHistory::create(
                [
                    'type' => $request->type,
                    'status' => $request->status,
                    'amount' => $request->amount,
                    'description' => $request->description,
                    'house_id' => $request->house_id,
                    'householder_id' => $user->id,
                    'billing_id' => $request->billing_id,
                    'next_billing_date' => $request->type == 'tahunan' ? now()->addYear() : null,
                    ]
            );

            return TransactionHistoryResource::make($transactionHistory)
                ->additional(
                    [
                        'code' => $code,
                        'success' => $success,
                        'message' => $message,
                    ]
                );
        } catch (\Throwable $th) {

            Log::error($th->getMessage());
            $code = Response::HTTP_INTERNAL_SERVER_ERROR;

            return response()->json(
                [
                    'success' => false,
                    'message' => $th->getMessage(),
                ],
                $code
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TransactionHistory $transactionHistory)
    {
        $code = Response::HTTP_OK;
        $success = true;
        $message = __('messages.data_displayed');

        try {
            return TransactionHistoryResource::make($transactionHistory)
                ->additional([
                    'code' => $code,
                    'success' => $success,
                    'message' => $message,
                ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            $code = Response::HTTP_INTERNAL_SERVER_ERROR;

            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], $code);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionHistoryRequest $request, TransactionHistory $transactionHistory)
    {
        
        $code = Response::HTTP_OK;
        $success = true;
        $message = __('messages.data_saved');
        $user = auth('api')->user();

        try {

            $transactionHistory->update([
                'type' => $request->type,
                'status' => $request->status,
                'amount' => $request->amount,
                'description' => $request->description,
                'house_id' => $request->house_id,
                'householder_id' => $user->id,
                'billing_id' => $request->billing_id,
                ]
            );

            return TransactionHistoryResource::make($transactionHistory)
                ->additional([
                    'code' => $code,
                    'success' => $success,
                    'message' => $message,
                ]
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            $code = Response::HTTP_INTERNAL_SERVER_ERROR;

            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], $code);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionHistory $transactionHistory)
    {
        $code = Response::HTTP_OK;
        $success = true;
        $message = __('messages.data_deleted');

        try {
            $transactionHistory->delete();
        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            $code = Response::HTTP_INTERNAL_SERVER_ERROR;
            $success = false;
            $message = $th->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ], $code);
    }
}
