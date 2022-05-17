<?php

namespace App\Repositories;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImageRepository
{
    public function saveImage($image, $id, $type, $size)
    {
        if (!is_null($image))
        {
            $file = $image;
            $extension = $image->getClientOriginalExtension();

            $fileName = time() . random_int(100, 999) .'.' . $extension;
            $destinationPath = public_path('images/'.$type.'/'.$id.'/');
            $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . '://' .$_SERVER['HTTP_HOST'].'/images/'.$type.'/'.$id.'/'.$fileName;

            if (!file_exists(public_path('images')))
            {
                File::makeDirectory(public_path('images'), 0775);
            }

            if (!file_exists(public_path('images/' . $type))) {
                File::makeDirectory(public_path('images/' . $type), 0775);
            }

            $fullPath = $destinationPath.$fileName;

            if (!file_exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0775);
            }

            $image = Image::make($file)
                ->resize($size, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->encode('jpg');
            $image->save($fullPath, 100);

            return $url;

        } else {
            return (isset($_SERVER['HTTPS']) ? "https" : "http") . '://' .$_SERVER['HTTP_HOST'].'/images/'.$type.'/' . $id . $image;
        }
    }

    public function deletaImg($path, $id)
    {
        $ArrPATH = explode("/", $path);
        $arquivo = public_path('images/filial/' . $id . '/' . $ArrPATH[count($ArrPATH) - 1]);
        if (file_exists($arquivo))
        {
            unlink($arquivo);
            return true;
        } else {
            return false;
        }

    }
}
