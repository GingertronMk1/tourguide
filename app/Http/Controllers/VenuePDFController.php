<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class VenuePDFController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Venue $venue)
    {
        // Generate view
        $view = view('pdfs.venue', compact('venue'));

        // Instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        return $dompdf->stream("{$venue->name}.pdf", ['Attachment' => 0]);
    }
}
