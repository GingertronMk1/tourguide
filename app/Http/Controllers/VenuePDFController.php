<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use App\Services\PdfGenerator;
use Illuminate\Http\Response;

class VenuePDFController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Venue $venue, PdfGenerator $pdf): Response
    {
        $fileName = "{$venue->name}.pdf";
        $createdPdf = $pdf->createPdf(
            'pdfs.venue',
            compact('venue'),
            'A4',
            ['isRemoteEnabled' => true]
        );

        return response()->make($createdPdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "inline; filename=\"{$fileName}\"",
        ]);
    }
}
