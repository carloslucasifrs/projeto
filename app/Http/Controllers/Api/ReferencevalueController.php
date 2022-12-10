<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreLaboratoryexamRequest;
use App\Http\Requests\Api\UpdateLaboratoryexamRequest;
use App\Http\Resources\Api\ReferencevalueResource;
use App\Models\Referencevalue;
use Illuminate\Http\Response;

class ReferencevalueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $referencevalues = Referencevalue::get();

        return ReferencevalueResource::collection($referencevalues)
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLaboratoryexamRequest $request)
    {
        $referencevalues = Referencevalue::create($request->all());

        return ReferencevalueResource::make($referencevalues)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Referencevalue $referencevalues)
    {
        return ReferencevalueResource::make($referencevalues)
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
    public function update(UpdateLaboratoryexamRequest $request, Referencevalue $referencevalues)
    {
        $referencevalues->update($request->all());

        return ReferencevalueResource::make($referencevalues)
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Referencevalue $referencevalues)
    {
        $referencevalues->deleteOrFail();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
