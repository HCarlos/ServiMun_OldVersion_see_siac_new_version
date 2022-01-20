<?php

namespace App\Http\Controllers\External\Denuncia;

use App\Classes\Denuncia\DenunciaTCPDF;
use App\Http\Controllers\Controller;
use App\Models\Denuncias\Denuncia;
use Carbon\Carbon;

define('NOMBRE_EMPRESA',config('atemun.nombre_empresa',''));

class HojaDenunciaController extends Controller
{


    public function imprimirDenuncia($Id=0){

        $den = Denuncia::find($Id);
        $folio  = $Id;
        $timex  = $den->fecha_ingreso->format('d-m-Y H:i:s');
        $FOLIO = "DAC-".str_pad($folio,6,'0',STR_PAD_LEFT)."-".$den->fecha_ingreso->format('y');
        $alto   = 6;

        $pdf = new DenunciaTCPDF('','mm',array(215.9, 139.7), true, 'UTF-8', false);
        $pdf->FOLIO = $FOLIO;
        $pdf->folio = $folio;
        $pdf->timex = $timex;

        $pdf->Init();
        $pdf->AddPage();

        $pdf->setCellPaddings(1, 1, 1, 1);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// Linea 1
        $pdf->setX(5);
        $pdf->Ln(40);
        $pdf->SetLeftMargin(50);
        $pdf->SetRightMargin(40);
        $pdf->setFormDefaultProp([279,140]);
        $pdf->SetFont(FONT_AEALARABIYA,'B',11);
        $pdf->SetTextColor(64,64,64);
        $pdf->SetFillColor(255,255,255);

        $roles = $den->ciudadano->RoleNameStrArray;
        $username = $den->ciudadano->username;
        $html = ATEMUN['style']['denuncia'];
        $html .= "<p>Estimado <bAzul>C. {$den->ciudadano->FullName}</bAzul> (<bChocolate>{$den->ciudadano->id}</bChocolate>, <bOrange>$username</bOrange>), su petición ha sido recibida y se iniciará el trámite pertinente. <br><br>";
        $html .= "El <b>". NOMBRE_EMPRESA . "</b> agradece su colaboración y le garantiza confidencialidad y una pronta respuesta.  <br><br>";
        $html .= "Fue atendido por <bVerde>C. {$den->creadopor->FullName}</bVerde>. <br>";
        $html .= "</p>";
        $html .= "<span></span>";
        $html .= "<pCentrado>";
        $html .= env('INFO_TWO'). "<br>";
        $html .= "<span></span>";
        $html .= "<a href='".env('INFO_FOUR')."'>".env('INFO_FOUR'). "</a>";
        $html .= "</pCentrado>";

        $pdf->WriteHTMLCell(195,$alto,10,$pdf->getY(),$html,0,0);

        // Inicia proceso de Sellado

        $mensaje = public_path() . "/signature/mensaje.txt";
        $firmado = public_path() . "/signature/firmado.txt";
        $key_pem = public_path() . "/signature/Claveprivada_FIEL_HIRC711126JT0_20211206_140329.pem";
        $pem     = public_path() . "/signature/hirc711126jt0.pem";
        $fp = fopen(public_path() . "/signature/mensaje.txt", "w");

        $cadena_original = $den->id.'|'.$pdf->FOLIO.'|'.$pdf->timex.'|'.$den->ciudadano->id.'|'.$den->ciudadano->username.'|'.$den->ciudadano->FullName.'|'.$den->creadopor->id.'|'.$den->creadopor->username.'|'.$den->creadopor->FullName.'|'.$den->dependencia_id.'|'.$den->ubicacion_id.'|'.$den->servicio_id.'|'.$den->estatus_id;
        $hash = sha1($cadena_original);

        fwrite($fp, $hash);
        fclose($fp);

        $key=$key_pem;
        $fp = fopen($key, "r");
        $priv_key = fread($fp, 8192);

        $pkeyid = openssl_get_privatekey($priv_key);

        if (openssl_sign($mensaje, $firmado, $pkeyid,OPENSSL_ALGO_SHA1)) {
            $sello = base64_encode($firmado);
        }
        $pdf->SetTextColor(64,64,64);
        $pdf->SetFillColor(255,255,255);

        $pdf->SetFont(FONT_DEJAVUSANSMONO,'B',7);
        $pdf->WriteHTMLCell(200,$alto,5,107, "<p><bSelloBold>CADENA ORIGINAL:</bSelloBold></p>",0,0);
        $pdf->SetFont(FONT_AEALARABIYA,'',6);
        $pdf->WriteHTMLCell(200,$alto,5,110, $cadena_original,0,0);

        $pdf->SetFont(FONT_DEJAVUSANSMONO,'B',7);
        $pdf->WriteHTMLCell(200,$alto,5,117, "<bSelloBold>HASH:</bSelloBold>",0,0);
        $pdf->SetFont(FONT_AEALARABIYA,'',6);
        $pdf->WriteHTMLCell(200,$alto,5,120, $hash,0,0);

        $pdf->SetFont(FONT_DEJAVUSANSMONO,'B',7);
        $pdf->WriteHTMLCell(200,$alto,5,124, "<bSelloBold>SELLO DIGITAL:</bSelloBold>",0,0);
        $pdf->SetFont(FONT_AEALARABIYA,'',6);
        $pdf->WriteHTMLCell(200,$alto,5,127, $sello,0,0);

        // Finaliza proceso de Sellado

        $pdf->Output($pdf->FOLIO . '.pdf');

    }
}
