<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\EnumResource;
use App\Models\Enum;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class EnumController extends Controller
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
        $houseStatus = $request->type ?? null;

        try {

            $user = auth('api')->user();

            $enums = Enum::query()
                ->latest('created_at');

                if ($houseStatus !== null) {
                    $enums->where('type', $houseStatus);
                }

            $enums = $enums->paginate($perPage, ['*'], 'page', $page);

            return EnumResource::collection($enums)
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
    public function show(Enum $enum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enum $enum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enum $enum)
    {
        //
    }
}
