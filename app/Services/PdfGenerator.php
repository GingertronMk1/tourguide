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
        ?bool $asAttachment = false,
        ?string $paperSize = 'A4',
        ?string $fileName = 'PDF.pdf',
        ?array $options = []
    ) {
        $pdfOptions = $this->pdf->getOptions();
        $pdfOptions->set($options);
        $this->pdf->setOptions($pdfOptions);
        $templateVars['fileName'] = $fileName;
        $view = view($template, $templateVars)->render();
        $this->pdf->loadHtml($view);
        $this->pdf->setPaper($paperSize);
        $this->pdf->render();

        return $this->pdf->stream(
            $fileName,
            ['Attachment' => (int) $asAttachment]
        );
    }
}
