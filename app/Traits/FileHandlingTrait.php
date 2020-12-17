<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait FileHandlingTrait
{
    public function uploadFile(UploadedFile $file, $path = null, $fileName = null, $disk = 'public')
    {
        if (empty($fileName)) {
            $fileName = time(). ''. Str::random(25) . $file->getClientOriginalName();
        }

        return $file->storeAs($path, $fileName, $disk);
    }

    public function deleteFile($path = null, $disk = 'public'){

        if( Storage::disk($disk)->exists($path) ){

            Storage::disk($disk)->delete($path);

        }
        
    }
}