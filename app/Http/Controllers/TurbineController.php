<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTurbineRequest;
use App\Http\Requests\UpdateTurbineRequest;
use App\Http\Resources\TurbineResource;
use App\Repositories\TurbineRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TurbineController extends Controller
{
    public function index(TurbineRepositoryInterface $turbineRepository): ResourceCollection
    {
        return TurbineResource::collection($turbineRepository->getAll());
    }

    public function store(
        StoreTurbineRequest $request,
        TurbineRepositoryInterface $turbineRepository
    ): JsonResource|JsonResponse {
        DB::beginTransaction();

        try {
            $turbine = $turbineRepository->create($request->data());

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            report($e);
            Log::error('Turbine was not created.');

            return response()->json([], 500);
        }

        return new TurbineResource($turbine);
    }

    public function show(int $id, TurbineRepositoryInterface $turbineRepository): TurbineResource
    {
        if (!$turbine = $turbineRepository->find($id)) {
            abort(404);
        }

        return new TurbineResource($turbine);
    }

    public function update(
        int $id,
        UpdateTurbineRequest $request,
        TurbineRepositoryInterface $turbineRepository
    ): TurbineResource|JsonResponse {
        if (!$turbine = $turbineRepository->find($id)) {
            abort(404);
        }

        DB::beginTransaction();

        try {
            $turbineRepository->update($request->data(), $turbine);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            report($e);
            Log::error('Turbine was not updated.');

            return response()->json([], 500);
        }

        return new TurbineResource($turbine);
    }

    public function destroy(int $id, TurbineRepositoryInterface $turbineRepository): Response
    {
        $turbineRepository->delete($id);

        return response()->noContent();
    }
}
