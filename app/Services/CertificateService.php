<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class CertificateService
{
    public static function generateCertificate($ownedCourse)
    {
        $font = storage_path('app/certificate/font/Roboto_Condensed/static/RobotoCondensed-SemiBoldItalic.ttf');
        $image = imagecreatefrompng(storage_path('app/certificate/design/1.png'));

        $name = auth()->user()->name;
        $courseName = '"' . $ownedCourse->title . '"';

        $width = imagesx($image);
        $height = imagesy($image);
        $textColor = imagecolorallocate($image, 1, 81, 104);
        $courseNameColor = imagecolorallocate($image, 0, 180, 203);

        $nameSize = imageftbbox(200, 0, $font, $name);
        $courseNameSize = imageftbbox(50, 0, $font, $courseName);

        $nameTextWidth =  $nameSize[2] - $nameSize[0];
        $nameTextHeight = $nameSize[3] - $nameSize[5];
        $nameX = ($width - $nameTextWidth) / 2;
        $nameY = ($height - $nameTextHeight) / 2;

        $courseNameTextWidth =  $courseNameSize[2] - $courseNameSize[0];
        $courseNameTextHeight = $courseNameSize[3] - $courseNameSize[5];
        $courseNameX = ($width - $courseNameTextWidth) / 2;
        $courseNameY = ($height - $courseNameTextHeight) / 2;

        imagettftext($image, 200, 0, $nameX, $nameY + 300, $textColor, $font, $name);
        imagettftext($image, 50, 0, $courseNameX, $courseNameY + 530, $courseNameColor, $font, $courseName);

        return $image;
    }
}
