<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Mypdfgenerator
{
    protected $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function generate($view, $data = array(), $filename = 'laporan', $paper = 'A4', $orientation = 'landscape')
    {
        // Create a Dompdf instance
        $dompdf = new Dompdf();

        // Load your view into HTML
        $html = $this->ci->load->view($view, $data, TRUE);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // // Set additional options
        // $dompdf->set_option('isRemoteEnabled',TRUE);
        $dompdf->set_option('isRemoteEnabled', TRUE);

        $dompdf->setPaper($paper, $orientation);

        // Render PDF (generate)
        $dompdf->render();

        // Stream the file to the browser
        $dompdf->stream($filename . ".pdf", array("Attachment" => false));
    }
}
