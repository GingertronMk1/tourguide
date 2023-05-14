<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use App\Services\PdfGenerator;

class VenuePDFController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Venue $venue, PdfGenerator $pdf)
    {
        // Generate view
        $generated = $pdf->createPdf(
            'pdfs.venue',
            compact('venue'),
            false,
            'A4',
            "{$venue->name}.pdf"
        );

        return response($generated);
    }
}
