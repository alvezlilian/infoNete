<?php
require_once ('dependencies/dompdf/autoload.inc.php');

class domPDF
{

    /**
     * @var Dompdf
     */
    private $dompdf;

    public function __construc(){

    }

    public function imp($html){
        // instantiate and use the dompdf class
        $this->dompdf = new domPDF();
        $this->dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper('A4', 'portrait');
// Render the HTML as PDF
        $this->dompdf->render();

// Output the generated PDF to Browser
        $this->dompdf->stream("document.pdf" , ['Attachment' => 0]);
        //0 previsualiza documento
        //1 solicita guardar documento
    }
}