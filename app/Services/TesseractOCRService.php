<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Laboratoryexam;
use Illuminate\Http\UploadedFile;
use thiagoalessio\TesseractOCR\TesseractOCR;

class TesseractOCRService
{
    public function __construct(protected UploadedFile $file)
    {
    }

    public function getLaboratoryExamValues(): array
    {
        $laboratoryexams_value = [];

        $string_convert = $this->convertImageString();
        if (! empty($string_convert)) {
            $laboratory_exams = $this->getLaboratoryExam();

            foreach ($laboratory_exams as $value) {
                $valueFormat = $this->formatStringSpecialCharacter($value['exam']);

                $position = stripos($string_convert, $valueFormat);

                if ($position !== false) {
                    $position = strlen($value['exam']) + $position;

                    $rest = substr($string_convert, $position, 10);
                    $rest = preg_replace('/[^0-9,.]/', '', $rest);
                    $rest = preg_replace('/,/', '.', $rest);

                    array_push(
                        $laboratoryexams_value,
                        [
                            'laboratoryexam_id' => $value['id'],
                            'exam' => $value['exam'],
                            'value' => floatval($rest),
                        ]
                    );
                }
            }
        }

        return $laboratoryexams_value;
    }

    public function convertImageString(): string
    {
        $tesseract = new TesseractOCR($this->file);

        $string = $tesseract
            ->psm(6)
            ->lang('por')
            ->txt()
            ->run();

        return $this->formatStringSpecialCharacter($string);
    }

    public function formatStringSpecialCharacter(String $string): String
    {
        $specialChar = [
            '/(á|à|ã|â|ä)/',
            '/(Á|À|Ã|Â|Ä)/',
            '/(é|è|ê|ë)/',
            '/(É|È|Ê|Ë)/',
            '/(í|ì|î|ï)/',
            '/(Í|Ì|Î|Ï)/',
            '/(ó|ò|õ|ô|ö)/',
            '/(Ó|Ò|Õ|Ô|Ö)/',
            '/(ú|ù|û|ü)/',
            '/(Ú|Ù|Û|Ü)/',
            '/(ñ)/',
            '/(Ñ)/',
        ];

        $char = explode(
            ' ',
            'a A e E i I o O u U n N'
        );

        return preg_replace($specialChar, $char, $string);
    }

    public function getLaboratoryExam(): array
    {
        $laboratoryexams = Laboratoryexam::all('exam', 'id')->toArray();

        return $laboratoryexams;
    }
}
