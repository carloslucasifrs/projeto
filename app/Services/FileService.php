<?php

declare(strict_types=1);

namespace App\Services;

use Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileService
{
    public static function uploadExam(UploadedFile $file): string
    {
        try {
            $name = Str::uuid() . '.' . $file->extension();

            $user = Auth::user();

            if (!$fileStore = $file->storeAs($user->id, $name)) {
                throw new \Exception('Erro ao fazer upload do arquivo');
            }
        } catch (\Throwable $th) {
            throw $th;
        }

        return $fileStore;
    }

    public static function deleteExam(String $file): bool
    {
        $statusDeleteFile = Storage::delete($file);
        return $statusDeleteFile;
    }

    public static function temporaryUrl(string|null $path, int $timeMinutes): string|null
    {
        if ($path === null) {
            return null;
        }

        if (Storage::exists($path) === false) {
            return null;
        }

        $time = now()->addMinutes($timeMinutes);
        return Storage::temporaryUrl($path, $time);
    }

    public static function fileUrl(string $path): string
    {
        return Storage::url('buckuetname/' . $path);
    }
}
