<?php

namespace App\Services;

use App\Models\Certificate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CertificateService
{
    public static function generateCertificate($ownedCourse)
    {
        $certificate = self::getCertificateByOwnedCourse($ownedCourse->id);
        if ($certificate === null) {
            abort(404);
        }

        $qrCode = QrCode::size(400)->format('png')->generate(route('validate.certificate', $certificate->certificate_number));

        $font = storage_path('app/certificate/font/Roboto_Condensed/static/RobotoCondensed-SemiBoldItalic.ttf');
        $image = imagecreatefrompng(storage_path('app/certificate/design/1.png'));
        $qrImage = imagecreatefromstring($qrCode);

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
        imagettftext($image, 50, 0, 1100, $height - 750, $textColor, $font, 'Verifikasi Sertifikat');

        imagecopy($image, $qrImage, 1100, $height - 685, 0, 0, imagesx($qrImage), imagesy($qrImage));

        return $image;
    }

    public static function getCertificateByOwnedCourse($ownedCourseId)
    {
        return Certificate::where('member_id', auth()->id())->where('owned_course_id', $ownedCourseId)->first();
    }

    public static function upsertCertificate($ownedCourseId)
    {
        if (self::getCertificateByOwnedCourse($ownedCourseId) !== null) {
            return Certificate::where('member_id', auth()->id())
                ->where('owned_course_id', $ownedCourseId)
                ->update([
                    'last_issued_at' => Carbon::now()
                ]);
        }

        $certificateNumber = Str::ulid();

        return Certificate::create([
            'member_id' => auth()->id(),
            'owned_course_id' => $ownedCourseId,
            'certificate_number' => $certificateNumber,
            'first_issued_at' => Carbon::now(),
            'last_issued_at' => Carbon::now()
        ]);
    }

    public static function getByNumber($certificateNumber)
    {
        return Certificate::where('certificate_number', $certificateNumber)->first();
    }
}
