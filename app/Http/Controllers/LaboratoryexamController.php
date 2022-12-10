<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Laboratoryexam;
use Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class LaboratoryexamController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laboratoryexam  $laboratoryExam
     * @return \Inertia\Response
     */
    public function show(Laboratoryexam $laboratoryexam): Response
    {
        $exam_laboratoryexam = DB::table('exams')
            ->join('exam_laboratoryexam', 'exams.id', '=', 'exam_laboratoryexam.exam_id')
            ->select('exam_laboratoryexam.value', 'exams.date')
            ->where('exams.user_id', Auth::user()->id)
            ->where('laboratoryexam_id', $laboratoryexam->id)
            ->orderBy('date', 'asc')
            ->get();

        $laboratoryexam = Laboratoryexam::findorfail($laboratoryexam->id);

        $referenceValues = $laboratoryexam->referenceValues;

        return Inertia::render('Laboratoryexam/Show', [
            'laboratoryexam' => $laboratoryexam,
            'exam_laboratoryexam' => $exam_laboratoryexam,
        ]);
    }
}
