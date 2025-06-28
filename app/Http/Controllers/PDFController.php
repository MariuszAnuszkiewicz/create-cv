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

        $data['inputs'][0]['agreement'] = file_get_contents(public_path('agreement/pl/agreement.txt'), false);

        $pdf = PDF::loadView('pdf.cv.create', $data);
        $pdf->setPaper('a4', 'P');
        return $pdf->stream();
    }
}
