<?php
require_once ('dependencies/dompdf/autoload.inc.php');
use Dompdf\Dompdf;


class DomP
{
private $dompdf;

    public function __construct()
    {
    }
   public function recibirHtml($html){

// instantiate and use the dompdf class
       $dompdf = new Dompdf();
       $dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
       $dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
       $dompdf->render();

// Output the generated PDF to Browser
       $dompdf->stream("document.pdf" , ['Attachment' => 0]);

}
}