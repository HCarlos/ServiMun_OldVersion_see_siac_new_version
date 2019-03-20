<?php

namespace App\Http\Controllers\External\Denuncia;

use App\Classes\Denuncia\DenunciaTCPDF;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class HojaDenunciaController extends Controller
{


    public function imprimirDenuncia($Id=0){
        $this->timex       = Carbon::now()->format('d-m-Y H:i:s');
        $this->folio       = 0;
        $this->cliente_id  = 0;
        $this->vendedor_id = 0;
        $this->cliente     = "cliente";
        $this->vendedor    = "vendedor";
        $this->status      = "Estatus";
        $this->metodo_pago = "Metodo de pago";
        $this->referencia  = "referencia";
        $this->tipo_venta  = "tipo venta";
        $this->title       = "NOTA DE REMISIÓN";

//        $pdf = new DenunciaTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf = new DenunciaTCPDF();

//$pdf->AliasNbPages();
        $pdf->SetAutoPageBreak(TRUE, 0.1);
        $pdf->SetLeftMargin(5);


// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('@DevCH');
        $pdf->SetTitle('Denuncia');
        $pdf->SetSubject('Ciudadana');
        $pdf->SetKeywords('SIAC, SIACGOB, ATENCION CIUDADANA');

//// set default header data
        $pdf->setPrintHeader(true);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 005', PDF_HEADER_STRING);

// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $pdf->AddPage();

// set cell padding
        $pdf->setCellPaddings(1, 1, 1, 1);


// Linea 1
        $pdf->setX(5);
        $pdf->Ln(30);
        $pdf->SetFont('courier','B',8);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFillColor(92,92,92);
        $pdf->Cell(10,6,"LOTE",'LTRB',0,'C',true);
        $pdf->Cell(12,6,"CANT.",'TRB',0,'R',true);
        $pdf->Cell(30,6,"MEDIDA",'TRB',0,'C',true);
        $pdf->Cell(98,6,"DESCRIPCIÓN",'TRB',0,'C',true);
        $pdf->Cell(25,6,"P.V.",'TRB',0,'R',true);
        $pdf->Cell(25,6,"IMPORTE",'TRB',1,'R',true);
        $pdf->SetFont('courier','',6);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFillColor(255,255,255);

        $pdf->Output();

    }
}
