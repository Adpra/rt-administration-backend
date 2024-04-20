<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\HouseRequest;
use App\Http\Resources\v1\HouseResource;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', House::class);

        $code = Response::HTTP_OK;
        $success = true;
        $message = __('messages.data_list');
        $perPage = $request->per_page ?? 15;
        $page = $request->page ?? 1;

        try {

            $user = auth('api')->user();

            $houses = House::query()
                ->latest('created_at');

            if ($user && !$user->is_admin) {
                $houses = $houses->where('user_id', $user->id);
            }

            $houses = $houses->paginate($perPage, ['*'], 'page', $page);

            return HouseResource::collection($houses)
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
    public function store(HouseRequest $request)
    {
        $this->authorize('create', House::class);

        $code = Response::HTTP_CREATED;
        $success = true;
        $message = __('messages.data_saved');

        try {
            $house = House::create(
                [
                    'no' => $request->no,
                    'description' => $request->description,
                    'status' => $request->status,
                    'user_id' => $request->user_id,
                ]
            );

            return HouseResource::make($house)
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
    public function show(House $house)
    {
        $this->authorize('view', $house);

        $code = Response::HTTP_OK;
        $success = true;
        $message = __('messages.data_displayed');

        try {

            return HouseResource::make($house)
                ->additional([
                    'code' => $code,
                    'success' => $success,
                    'message' => $message,
                ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            $code = Response::HTTP_INTERNAL_SERVER_ERROR;

            return response()->json(
                [
                    'success' => false,
                    'message' => $th->getMessage()
                ],
                $code
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HouseRequest $request, House $house)
    {
        $this->authorize('update', $house);

        $code = Response::HTTP_OK;
        $success = true;
        $message = __('messages.data_saved');

        try {

            $house->update([
                'no' => $request->no,
                'description' => $request->description,
                'status' => $request->status,
                'user_id' => $request->user_id,
            ]);

            return HouseResource::make($house)
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
     * Remove the specified resource from storage.
     */
    public function destroy(House $house)
    {
        $this->authorize('delete', $house);

        $code = Response::HTTP_OK;
        $success = true;
        $message = __('messages.data_deleted');

        try {
            $house->delete();
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
