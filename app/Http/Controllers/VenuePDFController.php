<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Venue;
use App\Services\PdfGenerator;
use Illuminate\Http\Response;
use Illuminate\View\View;

class VenuePDFController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Venue $venue, PdfGenerator $pdf): Response|View
    {
        $fileName = "{$venue->name}.pdf";

        return $pdf->getPdfAsResponse(
            'pdfs.venue',
            compact('fileName', 'venue'),
            'A4',
            ['isRemoteEnabled' => true],
            $fileName
        );
    }
}
