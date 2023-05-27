<?php

declare(strict_types=1);

namespace App\Services;

use Dompdf\Dompdf;
use Illuminate\Http\Response;

class PdfGenerator
{
    public function __construct(
        private Dompdf $pdf
    ) {
    }

    public function createPdf(
        string $template,
        array $templateVars,
        ?string $paperSize = 'A4',
        ?array $options = []
    ): ?string {
        $pdfOptions = $this->pdf->getOptions();
        $pdfOptions->set($options);
        $this->pdf->setOptions($pdfOptions);
        $view = view($template, $templateVars)->render();
        $this->pdf->loadHtml($view);
        $this->pdf->setPaper($paperSize);
        $this->pdf->render();
        $output = $this->pdf->output();

        return $output;
    }

    public function getPdfAsResponse(
        string $template,
        array $templateVars,
        ?string $paperSize = 'A4',
        ?array $options = [],
        ?string $fileName = 'PDF.pdf',
        ?array $headers = []
    ): Response {
        $templateVars['fileName'] = $fileName;
        $createdPdf = $this->createPdf(
            $template,
            $templateVars,
            $paperSize,
            $options
        );
        $headers['Content-Type'] = 'application/pdf';
        $headers['Content-Disposition'] = "inline; filename=\"{$fileName}\"";

        return response()->make($createdPdf, 200, $headers);
    }
}
