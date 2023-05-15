<?php

namespace App\Services;

use Dompdf\Dompdf;

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
}
