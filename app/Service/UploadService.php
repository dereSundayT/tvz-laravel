<?php
namespace App\Service;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;


class UploadService{
    public function upload($file,$folderName,$size,$old_file_name): string
    {
        try{
            $filename = time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put("$folderName/" . $filename, file_get_contents($file));
            return $filename;
        }
        catch (\Throwable $throwable){
            return $throwable;
        }

    }
}
