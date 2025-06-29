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

        $sourcePictures = public_path('pictures/cv/');

        $fileService->uploadFile($request, $sourcePictures);

        $addPictureToData = function(&$data) use ($sourcePictures, $fileService) {
            $getLastFile = $fileService->getLastFile($sourcePictures);
            $data['inputs'][0]['file'][] = $getLastFile;
        };

        $addPictureToData($data);

        if (isset($data['inputs'][0]['set_pl'])) {
            $data['inputs'][0]['agreement'] = file_get_contents(public_path('agreement/pl/agreement.txt'), false);
        } else {
            $data['inputs'][0]['agreement'] = file_get_contents(public_path('agreement/en/agreement.txt'), false);
        }

        $pdf = PDF::loadView('pdf.cv.create', $data);
        $pdf->setPaper('a4', 'P');
        return $pdf->stream();
    }
}
