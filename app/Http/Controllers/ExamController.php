<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Models\Exam;
use App\Models\Laboratory;
use App\Services\FileService;
use App\Services\TesseractOCRService;
use App\Services\uploadExam;
use App\Services\uploadService;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        // lists all laboratory tests performed by the authenticated user with their respective quantities
        $examsUser = DB::table('exams')
            ->join('exam_laboratoryexam', 'exams.id', '=', 'exam_laboratoryexam.exam_id')
            ->leftJoin('laboratoryexams', 'exam_laboratoryexam.laboratoryexam_id', '=', 'laboratoryexams.id')
            ->selectRaw('count(laboratoryexam_id) as qtd, laboratoryexam_id, exam')
            ->groupBy('laboratoryexam_id', 'exam')
            ->where('exams.user_id', Auth::user()->id)
            ->get();

        // lists all laboratory tests except those that the user has already performed
        $laboratoryexams = DB::table('laboratoryexams')
            ->when($examsUser, function ($query, $exams) {
                return $query->whereNotIn('id', $exams->pluck('laboratoryexam_id'));
            })
            ->selectRaw('(select 0) as qtd, laboratoryexams.id as laboratoryexam_id, exam')
            ->get();

        // creates a single array uniting containing exams and quantity
        $exams = Arr::collapse([$examsUser, $laboratoryexams]);

        $examUser = Exam::where('user_id', Auth::user()->id)->with('laboratory')->get();

        return Inertia::render('Exam/Index', [
            'exams' => $exams,
            'examUser' => $examUser,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        $laboratories = Laboratory::all('id', 'name');

        return Inertia::render(
            'Exam/Create',
            [
                'laboratories' => $laboratories,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExamRequest  $request
     * @return \Inertia\Response
     */
    public function store(StoreExamRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');

                $uploadExam = FileService::uploadExam($file);

                $tesseract = new TesseractOCRService($file);

                $laboratorialexamValues = $tesseract->getLaboratoryExamValues();
            }

            $exam = Exam::create([
                'date' => $request->date,
                'file' => $uploadExam ? $uploadExam : null,
                'laboratory_id' => $request->laboratory_id,
                'user_id' => Auth::user()->id,
            ]);

            if (!empty($laboratorialexamValues)) {
                foreach ($laboratorialexamValues as $laboratorialexamValue) {
                    $exam->laboratoryexams()
                        ->attach(
                            $laboratorialexamValue['laboratoryexam_id'],
                            ['value' => $laboratorialexamValue['value']]
                        );
                }
            }
        } catch (Throwable $e) {
            DB::rollBack();
            FileService::deleteExam($uploadExam);
            report($e);
            throw new $e();
        }

        DB::commit();

        return Redirect::route('examLaboratoryexams.index', [
            'exam' => $exam,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Inertia\Response
     */
    public function show(Exam $exam): Response
    {
        $exam->laboratory;
        $exam->laboratoryexams;

        return Inertia::render('Exam/Show', [
            'exam' => $exam,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Inertia\Response
     */
    public function edit(Exam $exam): Response
    {
        $laboratories = Laboratory::all('id', 'name');

        $examFile = FileService::temporaryUrl($exam->file, 15);

        return Inertia::render(
            'Exam/Edit',
            [
                'laboratories' => $laboratories,
                'exam' => $exam,
                'examFile' => $examFile,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExamRequest  $request
     * @param  \App\Models\Exam  $exam
     * @return \Inertia\Response
     */
    public function update(UpdateExamRequest $request, Exam $exam): RedirectResponse
    {
        $exam->laboratory_id = $request->laboratory_id;
        $exam->date = $request->date;
        $exam->file = $request->file;
        $exam->save();

        return Redirect::route('exams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Inertia\Response
     */
    public function destroy(Exam $exam): RedirectResponse
    {
        $exam->delete();

        return Redirect::route('exams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Inertia\Response
     */
    public function destroyFile(Exam $exam): RedirectResponse
    {
        FileService::deleteExam($exam->file);

        $exam->file = null;
        $exam->save();


        return Redirect::route('exams.index');
    }
}
