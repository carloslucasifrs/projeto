<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreLaboratoryexamRequest;
use App\Http\Requests\Api\UpdateLaboratoryexamRequest;
use App\Http\Resources\Api\LaboratoryexamResource;
use App\Models\Laboratoryexam;
use Illuminate\Http\Response;

class LaboratoryexamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laboratoryexam = Laboratoryexam::get();

        return LaboratoryexamResource::collection($laboratoryexam)
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
        $laboratoryexam = Laboratoryexam::create($request->all());

        return LaboratoryexamResource::make($laboratoryexam)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Laboratoryexam $laboratoryexam)
    {
        return LaboratoryexamResource::make($laboratoryexam)
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
    public function update(UpdateLaboratoryexamRequest $request, Laboratoryexam $laboratoryexam)
    {
        $laboratoryexam->update($request->all());

        return LaboratoryexamResource::make($laboratoryexam)
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laboratoryexam $laboratoryexam)
    {
        $laboratoryexam->deleteOrFail();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
