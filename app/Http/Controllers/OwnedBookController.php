<?php

namespace App\Http\Controllers;

use App\Services\OwnedBookService;
use DevRaeph\PDFPasswordProtect\Facade\PDFPasswordProtect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Response;

class OwnedBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.member.book.index');
    }

    /**
     * Download a book
     */
    public function download($id)
    {
        $ownedBook = OwnedBookService::getById($id);
        PDFPasswordProtect::setInputFile($ownedBook->book->file)
            ->setOutputFile('temp/' . $ownedBook->transaction_detail_id . '/' . $ownedBook->book->file)
            ->setPassword($ownedBook->key)
            ->secure();

        $filename = Str::slug($ownedBook->title) . '.pdf';
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "attachment; filename=" . $filename,
        ];


        return Storage::disk('local')->download('temp/' . $ownedBook->transaction_detail_id . '/' . $ownedBook->book->file, $filename, $headers);
    }
}
