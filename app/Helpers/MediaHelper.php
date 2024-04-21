<?php

namespace App\Helpers;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaHelper
{
    public static function handleUploadImage(?string $image, string $directory = 'images', ?string $oldFile = null, $model = null)
    {
        if ($model && $image === $model->photo_ktp ) {
            return $model->photo_ktp;
        }
        
        if (!$image) {
            return null;
        }

       
        if ($oldFile) {
            Storage::disk('public')->delete("$directory/$oldFile");
        }

        if (self::isBase64Image($image)) {
            $base64ImageDecoded = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));

            $mimeType = explode('/', getimagesizefromstring($base64ImageDecoded)['mime'])[1];
            if (!in_array($mimeType, ['jpeg', 'jpg', 'png'])) {
                throw new Exception('Invalid image format. Only JPEG, JPG, and PNG are supported.');
            }

            $fileName = Str::random(40) . ".$mimeType";

            Storage::disk('public')->put("$directory/$fileName", $base64ImageDecoded);

            $url = url(Storage::url("$directory/$fileName"));

            return $url;
        }

        return null;
    }

    private static function isBase64Image($str)
    {
        $str = preg_replace('#^data:image/\w+;base64,#i', '', $str);
        $decoded = base64_decode($str, true);

        return $decoded !== false && preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $str);
    }
}
