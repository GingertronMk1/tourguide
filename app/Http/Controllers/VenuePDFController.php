<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use App\Services\PdfGenerator;

class VenuePDFController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Venue $venue, PdfGenerator $pdf): void
    {
        // Generate view
        $pdf->createPdf(
            'pdfs.venue',
            compact('venue'),
            false,
            'A4',
            "{$venue->name}.pdf",
            ['isRemoteEnabled' => true]
        );
    }
}
