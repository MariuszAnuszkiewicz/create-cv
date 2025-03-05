<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function createPDF()
    {
        return view('pdf.index');
    }

    public function generatePDF(Request $request, FileService $fileService)
    {
        $data = $request->only(['inputs']);
        $sourcePath = public_path('pictures/cv/');

        $fileService->uploadFile($request, $sourcePath);

        $addPictureToData = function(&$data) use ($sourcePath, $fileService) {
            $getLastFile = $fileService->getLastFile($sourcePath);
            $data['inputs'][0]['file'][] = $getLastFile;
        };
        $addPictureToData($data);

        $pdf = PDF::loadView('pdf.cv.create', $data);
        return $pdf->stream();
    }
}
