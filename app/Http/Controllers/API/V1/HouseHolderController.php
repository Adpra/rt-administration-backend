<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\MediaHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\HouseHolderRequest;
use App\Http\Resources\v1\HouseHolderResource;
use App\Models\HouseHolder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class HouseHolderController extends Controller
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

            $houseHolders = HouseHolder::query()
                ->latest('created_at');

            if ($user && !$user->is_admin) {
                $houseHolders = $houseHolders->where('house_id', $user->house->id);
            }

            $houseHolders = $houseHolders->paginate($perPage, ['*'], 'page', $page);

            return HouseHolderResource::collection($houseHolders)
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
    public function store(HouseHolderRequest $request)
    {
        $this->authorize('create', HouseHolder::class);
        $code = Response::HTTP_CREATED;
        $success = true;
        $message = __('messages.data_saved');
        $user = auth('api')->user();

        try {
            $houseHolder = HouseHolder::create(
                [
                    'name' => $request->name,
                    'photo_ktp' => MediaHelper::handleUploadImage($request->photo_ktp),
                    'status' => $request->status,
                    'marital_status' => $request->marital_status,
                    'phone' => $request->phone,
                    'house_id' => $user->is_admin ? $request->house_id : $user->house->id,
                ]
            );

            return HouseHolderResource::make($houseHolder)
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
    public function show(HouseHolder $householder)
    {
        $this->authorize('view', $householder);

        $code = Response::HTTP_OK;
        $success = true;
        $message = __('messages.data_displayed');

        try {
            return HouseHolderResource::make($householder)
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
    public function update(HouseHolderRequest $request, HouseHolder $householder)
    {
        $this->authorize('update', $householder);

        $code = Response::HTTP_OK;
        $success = true;
        $message = __('messages.data_saved');
        $user = auth('api')->user();

        try {
           
            $householder->update([
                'name' => $request->name,
                'photo_ktp' =>  MediaHelper::handleUploadImage($request->photo_ktp, 'images', null,$householder),
                'status' => $request->status,
                'marital_status' => $request->marital_status, 
                'phone' => $request->phone,
                'house_id' => $user->is_admin ? $request->house_id : $user->house->id,
            ]);

            return HouseHolderResource::make($householder)
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
    public function destroy(HouseHolder $householder)
    {
        $this->authorize('delete', $householder);
        $code = Response::HTTP_OK;
        $success = true;
        $message = __('messages.data_deleted');

        try {
            $householder->delete();
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
