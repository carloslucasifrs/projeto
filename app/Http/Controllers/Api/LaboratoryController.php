<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreLaboratoryRequest;
use App\Http\Requests\Api\UpdateLaboratoryRequest;
use App\Http\Resources\Api\LaboratoryResource;
use App\Models\Laboratory;
use Illuminate\Http\Response;

class LaboratoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laboratory = Laboratory::get();

        return LaboratoryResource::collection($laboratory)
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLaboratoryRequest $request)
    {
        $laboratory = Laboratory::create($request->all());

        return LaboratoryResource::make($laboratory)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Laboratory $laboratory)
    {
        return LaboratoryResource::make($laboratory)
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLaboratoryRequest $request, Laboratory $laboratory)
    {
        $laboratory->update($request->all());

        return LaboratoryResource::make($laboratory)
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laboratory $laboratory)
    {
        $laboratory->deleteOrFail();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
