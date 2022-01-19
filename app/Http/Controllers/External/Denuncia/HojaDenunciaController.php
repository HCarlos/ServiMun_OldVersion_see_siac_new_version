<?php

namespace App\Http\Controllers\External\Denuncia;

use App\Classes\Denuncia\DenunciaTCPDF;
use App\Http\Controllers\Controller;
use App\Models\Denuncias\Denuncia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

define('NOMBRE_EMPRESA',config('atemun.nombre_empresa',''));

class HojaDenunciaController extends Controller
{


    public function imprimirDenuncia($Id=0){
        $timex  = Carbon::now()->format('d-m-Y H:i:s');
        $folio  = $Id;
        $alto   = 6;

        // dd(NOMBRE_EMPRESA);

        $pdf = new DenunciaTCPDF('','mm',array(215.9, 139.7), true, 'UTF-8', false);
        $pdf->folio = $folio;
        $pdf->timex = $timex;

        $certificate =  'file://' . getcwd() . "/signature/tcpdf.crt";


        //$certificate =  'file://' . getcwd() . "/signature/hirc711126jt0.cer";
        $clave = "CH50Dev";

        if ( file_exists($certificate) ) {
            //echo $certificate;
            //return false;
        }else{
            echo $certificate;
            echo "No Existe";
            return false;
        }

        $info = array(
            'Name' => 'TCPDF',
            'Location' => 'Office',
            'Reason' => 'H. Ayuntamiento Constitucional del Municipio de Centro',
            'ContactInfo' => 'https://villahermosa.gob.mx',
        );

        $pdf->setSignature($certificate, $certificate, $clave, '', 3, $info);

        $pdf->Init();
        $pdf->AddPage();

        $pdf->setCellPaddings(1, 1, 1, 1);


// Linea 1
        $pdf->setX(5);
        $pdf->Ln(40);
        $pdf->SetLeftMargin(50);
        $pdf->SetRightMargin(40);
        $pdf->setFormDefaultProp([279,140]);
        $pdf->SetFont(FONT_AEALARABIYA,'B',12);
        $pdf->SetTextColor(64,64,64);
        $pdf->SetFillColor(255,255,255);

        $den = Denuncia::find($Id);
        $roles = $den->ciudadano->RoleNameStrArray;
        $username = $den->ciudadano->username;
        $html = ATEMUN['style']['denuncia'];
        $html .= "<p>Estimado <bAzul>{$den->ciudadano->FullName}</bAzul> (<bChocolate>{$den->ciudadano->id}</bChocolate>, <bOrange>$username</bOrange>), su petición ha sido recibida y se iniciará el trámite pertinente. <br><br>";
        $html .= "El <b>". NOMBRE_EMPRESA . "</b> agradece su colaboración y le garantiza confidencialidad y una pronta respuesta.  <br><br>";
        $html .= "Fue atendido por <bVerde>{$den->creadopor->FullName}</bVerde>. <br><br>";
        $html .= "</p>";
        $html .= "<span></span>";
        $html .= "<pCentrado>";
        $html .= env('INFO_TWO'). "<br>";
        $html .= "<span></span>";
        $html .= env('INFO_THREE'). "<br>";
        $html .= "<span></span>";
        $html .= "<a href='".env('INFO_FOUR')."'>".env('INFO_FOUR'). "</a>";
        $html .= "</pCentrado>";

        // $certificate = public_path() . '/signature/hirc711126jt0.cer';

        //$certificate = 'file://' .getcwd() . "/signature/hirc711126jt0.cer";


//        $xxxx = openssl_pkcs7_sign(realpath("msg.txt"), "signed.txt",
//            'file://'.realpath('/home/zarsamco/public_html/eghtesad/certs/zarsamhonar.pem'),
//            array ('file://'.realpath('/home/zarsamco/public_html/eghtesad/certs/zarsamhonar.pem'), "secretPass"),
//            array (), PKCS7_NOSIGS
//        );

// set document signature

        $pdf->WriteHTMLCell(120,$alto,$pdf->getX(),$pdf->getY(),$html,0,0);

        $pdf->SetFont(FONT_AEALARABIYA,'B',6);
        $pdf->WriteHTMLCell(120,$alto,5,132,"Este documento está firmado digitalmente",0,0);



// define active area for signature appearance
        $pdf->setSignatureAppearance($pdf->getX(),$pdf->getY(), 120, $alto);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// *** set an empty signature appearance ***
//$pdf->addEmptySignatureAppearance(180, 80, 15, 15);


        $pdf->Output();

    }
}
