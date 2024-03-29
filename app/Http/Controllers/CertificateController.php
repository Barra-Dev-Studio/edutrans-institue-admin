<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Services\CertificateService;
use App\Services\OwnedCourseService;
use App\Services\RatingService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CertificateController extends Controller
{
    public function index()
    {
        $ownedCourses = OwnedCourseService::get();
        $certificates = [];
        foreach ($ownedCourses as $ownedCourse) {
            if ($ownedCourse->course->is_certified && OwnedCourseService::checkIfCompleteTheCourse($ownedCourse->id)) {
                $certificates[] = (object) [
                    'id' => $ownedCourse->id,
                    'title' => $ownedCourse->title,
                ];
            }
        }

        return view('pages.certificate.member.index', compact('certificates'));
    }
    public function generateCertificate($id)
    {
        if (!OwnedCourseService::checkIfCompleteTheCourse($id)) {
            abort(404);
        }

        $ownedCourse = OwnedCourseService::getById($id);
        $image = CertificateService::generateCertificate($ownedCourse);
        header("Content-type: image/png");
        imagepng($image);
        imagedestroy($image);
    }

    public function download($id)
    {
        if (!OwnedCourseService::checkIfCompleteTheCourse($id)) {
            abort(404);
        }
        $ownedCourse = OwnedCourseService::getById($id);

        if (!RatingService::checkIfUserRatedTheCourse($ownedCourse->course_id)) {
            return redirect()->route('member.rate.index', [$ownedCourse->id, 'certificate']);
        }

        $image = CertificateService::generateCertificate($ownedCourse);
        $tempFilePath = tempnam(sys_get_temp_dir(), 'image');
        imagepng($image, $tempFilePath);
        $name = "Certificate " . auth()->user()->name . " " . Carbon::now()->format('Y-m-d') . ".png";
        $headers = [
            'Content-Type' => 'image/png',
            'Content-Disposition' => "attachment; filename=$name",
        ];
        return Response::download($tempFilePath, $name, $headers)->deleteFileAfterSend(true);
    }

    public function validateNumber($certificateNumber)
    {
        $certificate = CertificateService::getByNumber($certificateNumber);

        if ($certificate === null) {
            abort (404);
        }

        if (!OwnedCourseService::checkIfCompleteTheCourseById($certificate->owned_course_id)) {
            abort(404);
        }

        return view('pages.certificate.validate', compact('certificate'));
    }
}
