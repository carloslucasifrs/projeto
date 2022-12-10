<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamLaboratoryexamRequest;
use App\Models\Exam;
use App\Models\Laboratoryexam;
use App\Services\FileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ExamLaboratoryexamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Exam $exam): Response
    {
        $exam->laboratoryexams;
        $exam->laboratory;
        $examFile = FileService::temporaryUrl($exam->file, 5);

        return Inertia::render('ExamLaboratoryexam/Index', [
            'exam' => $exam,
            'examFile' => $examFile,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Exam $exam): Response
    {
        $except = $exam->laboratoryexams->pluck('id')->toArray();

        $laboratoryexams = Laboratoryexam::all('id', 'exam')->except($except);

        return Inertia::render('ExamLaboratoryexam/Create', [
            'laboratoryexams' => $laboratoryexams,
            'exam' => $exam,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamLaboratoryexamRequest $request, Exam $exam): RedirectResponse
    {
        $exam->laboratoryexams()->attach(
            $request->laboratoryexam_id,
            ['value' => $request->value]
        );

        return Redirect::route('examLaboratoryexams.index', [
            'exam' => $exam,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam): Response
    {
        $exam->laboratory;

        $exam->laboratoryexams;

        return Inertia::render('ExamLaboratoryexam/Index', [
            'exam' => $exam,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam, int $laboratoryexamId): RedirectResponse
    {
        $exam->laboratoryexams()->detach($laboratoryexamId);

        return Redirect::route('examLaboratoryexams.index', ['exam' => $exam]);
    }
}
