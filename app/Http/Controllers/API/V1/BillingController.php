<?php

namespace App\Http\Controllers\API\v1;

use App\Enums\BillingStatusEnum;
use App\Enums\TransactionStatusEnum;
use App\Enums\TransactionTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\BillingRequest;
use App\Http\Resources\v1\BillingResource;
use App\Models\Billing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class BillingController extends Controller
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

            $billings = Billing::query()
                ->latest('created_at');

            $billings = $this->shouldExcludeTypeOfPayment($user, $billings);

            $billings = $billings->paginate($perPage, ['*'], 'page', $page);

            return BillingResource::collection($billings)
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
    public function store(BillingRequest $request)
    {
        $this->authorize('create', Billing::class);

        $code = Response::HTTP_CREATED;
        $success = true;
        $message = __('messages.data_saved');
        $user = auth('api')->user();

        try {
            $houseHolder = Billing::create(
                [
                    'type' => $request->type,
                    'description' => $request->description,
                    'amount' => $request->amount,
                    'status' => $request->status,
                ]
            );

            return BillingResource::make($houseHolder)
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
    public function show(Billing $billing)
    {
        
        $code = Response::HTTP_OK;
        $success = true;
        $message = __('messages.data_displayed');

        try {
            return BillingResource::make($billing)
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
    public function update(BillingRequest $request, Billing $billing)
    {
        $this->authorize('update', $billing);
        
        $code = Response::HTTP_OK;
        $success = true;
        $message = __('messages.data_saved');
        $user = auth('api')->user();

        try {

            $billing->update([
                'type' => $request->type,
                'description' => $request->description,
                'amount' => $request->amount,
                'status' => $request->status,
                ]
            );

            return BillingResource::make($billing)
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
    public function destroy(Billing $billing)
    {
        $this->authorize('delete', $billing);

        $code = Response::HTTP_OK;
        $success = true;
        $message = __('messages.data_deleted');

        try {
            $billing->delete();
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

   private function shouldExcludeTypeOfPayment($user, $billings)
    {
        if (!$user || $user->is_admin || !$user->house) {
            return $billings;
        }

        $billings = $billings->whereDoesntHave('transactions', function ($query) use ($user) {
            $query->where('status', TransactionStatusEnum::PAID)
                ->where('house_id', $user->house->id);
        });

        if ($user->house->transactions()->where('type', TransactionTypeEnum::TAHUNAN)->where('next_billing_date', '>=', now())->exists()) {
            $billings = $billings->where('status', '!=', BillingStatusEnum::KEBERSIHAN);
        }

        return $billings;
    }
}
