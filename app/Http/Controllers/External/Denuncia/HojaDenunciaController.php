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

//        require_once('tcpdf_include.php');

        $timex  = Carbon::now()->format('d-m-Y H:i:s');
        $date = new Carbon( $timex );
        $folio  = $Id;
        $FOLIO = "DAC-".str_pad($folio,6,'0',STR_PAD_LEFT)."-".$date->format('y');
        $alto   = 6;

        // dd(NOMBRE_EMPRESA);

        $pdf = new DenunciaTCPDF('','mm',array(215.9, 139.7), true, 'UTF-8', false);
        $pdf->FOLIO = $FOLIO;
        $pdf->folio = $folio;
        $pdf->timex = $timex;

//        $certificate =  'file://' . getcwd() . "/signature/tcpdf.crt";

        $certificate =  'file://' . getcwd() . "/signature/hirc711126jt0.cer";
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
            'Name' => 'SIAC',
            'Location' => 'H. Ayuntamiento Constitucional del Municipio de Centro, Tabasco, MX',
            'Reason' => 'Firma Digital de Documentos',
            'ContactInfo' => 'https://villahermosa.gob.mx',
        );

//        $pdf->setSignature($certificate, $certificate, $clave, '', 2, $info);
        //$pdf->SetProtection($permissions=array('print', 'copy'), $user_pass='CH50Dev', $owner_pass=null, $mode=1, $pubkeys=array(array('c' => $certificate, 'p' => array('print'))));

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
        $pdf->SetFont(FONT_AEALARABIYA,'B',12);
        $pdf->SetTextColor(64,64,64);
        $pdf->SetFillColor(255,255,255);

        $den = Denuncia::find($Id);
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

        $datos = $den->id.'|'.$pdf->FOLIO.'|'.$pdf->timex.'|'.$den->ciudadano->id.'|'.$den->ciudadano->username.'|'.$den->ciudadano->FullName.'|'.$den->creadopor->id.'|'.$den->creadopor->username.'|'.$den->creadopor->FullName.'|'.$den->dependencia_id.'|'.$den->dependencia_id.'|'.$den->servicio_id.'|'.$den->estatu_id;

        $pdf->WriteHTMLCell(195,$alto,10,$pdf->getY(),$html,0,0);

// guardar el mensaje en un archivo
        $mensaje = public_path() . "/signature/mensaje.txt";
        $firmado = public_path() . "/signature/firmado.txt";
        $key_pem = public_path() . "/signature/Claveprivada_FIEL_HIRC711126JT0_20211206_140329.pem";
        $pem     = public_path() . "/signature/hirc711126jt0.pem";
        $fp = fopen(public_path() . "/signature/mensaje.txt", "w");
        fwrite($fp, $datos);
        fclose($fp);

        $key=$key_pem;
        $fp = fopen($key, "r");
        $priv_key = fread($fp, 8192);

        $pkeyid = openssl_get_privatekey($priv_key);

        if (openssl_sign($mensaje, $firmado, $pkeyid,OPENSSL_ALGO_SHA1)) {
            $sello = base64_encode($firmado);
        }

        $pdf->SetFont(FONT_AEALARABIYA,'B',7);
        $pdf->WriteHTMLCell(200,$alto,5,115, "<b>CADENA ORIGINAL:</b>",0,0);
        $pdf->SetFont(FONT_AEALARABIYA,'',6);
        $pdf->WriteHTMLCell(200,$alto,5,118, $datos,0,0);

        $pdf->SetFont(FONT_AEALARABIYA,'B',7);
        $pdf->WriteHTMLCell(200,$alto,5,122, "<b>SELLO DIGITAL:</b>",0,0);
        $pdf->SetFont(FONT_AEALARABIYA,'',6);
        $pdf->WriteHTMLCell(200,$alto,5,125, $sello,0,0);

//        $pdf->WriteHTMLCell(195,$alto,5,120, $sello,0,0);

        /*
        //        $datos = $html;
                //dd($datos);
                if (file_exists('/etc/ssl/openssl.cnf')){
        //            echo "Existe";
                }
        //Se deben crear dos claves aparejadas, una clave pública y otra privada
        //A continuación el array de configuración para la creación del juego de claves
                $configArgs = array(
                    'config' => '/etc/ssl/openssl.cnf', //<-- esta ruta es necesaria si trabajas con XAMPP
                    'private_key_bits' => 8192,
                    'private_key_type' => OPENSSL_ALGO_SHA1
                );
                $resourceNewKeyPair = openssl_pkey_new($configArgs);
                if (!$resourceNewKeyPair) {
                    echo 'Puede que tengas problemas con la ruta indicada en el array de configuración "$configArgs" ';
                    echo openssl_error_string(); //en el caso que la función anterior de openssl arrojará algun error, este sería visualizado gracias a esta línea
                    exit;
                }
        //obtengo del recurso $resourceNewKeyPair la clave publica como un string
                $details = openssl_pkey_get_details($resourceNewKeyPair);
                $publicKeyPem = $details['key'];
        //        echo $publicKeyPem;
        //obtengo la clave privada como string dentro de la variable $privateKeyPem (la cual es pasada por referencia)
                if (!openssl_pkey_export($resourceNewKeyPair, $privateKeyPem, NULL, $configArgs)) {
                    echo openssl_error_string(); //en el caso que la función anterior de openssl arrojará algun error, este sería visualizado gracias a esta línea
                    exit;
                }
        //guardo la clave publica y privada en disco:
                file_put_contents('private_key.pem', $privateKeyPem);
                file_put_contents('public_key.pem', $publicKeyPem);
        //si bien ya tengo cargado el string de la clave privada, lo voy a buscar a disco para verificar que el archivo private_key.pem haya sido correctamente generado:
                $privateKeyPem = file_get_contents('private_key.pem');
        //obtengo la clave privada como resource desde el string
                $resourcePrivateKey = openssl_get_privatekey($privateKeyPem);
        //crear la firma dentro de la variable $firma (la cual es pasada por referencia)
                if (!openssl_sign($datos, $firma, $resourcePrivateKey, OPENSSL_ALGO_SHA256)) {
                    echo openssl_error_string(); //en el caso que la función anterior de openssl arrojará algun error, este sería visualizado gracias a esta línea
                    exit;
                }
        // guardar la firma en disco:
                //echo $firma;
                file_put_contents('signature.dat', $firma);
        // comprobar la firma
                if (openssl_verify($datos, $firma, $publicKeyPem, 'sha256WithRSAEncryption') === 1) {
                    $sello =  base64_encode($firma);
                } else {
                    //echo 'la firma es invalida y/o los datos fueron alterados';
                }
        //echo $sello;
                $pdf->SetFont(FONT_AEALARABIYA,'B',6);
                $pdf->WriteHTMLCell(120,$alto,5,110, $sello,0,0);


        //        $pdf->Image('images/tcpdf_signature.png', $pdf->getX(),$pdf->getY(), 120, $alto, 'PNG');
        //        $pdf->setSignatureAppearance($pdf->getX(),$pdf->getY(), 120, $alto);
        //        $pdf->addEmptySignatureAppearance($pdf->getX(),$pdf->getY(), 120, $alto);


        */

        //$pdf->set
//        QrCode::color(255,0,255); //Cambia el color de nuestro codigo
//        QrCode::backgroundColor(255,255,0); //Le añade el color al background del codigo
//        QrCode::margin(100);
//
//        $pdf->Image(QrCode::generate('http://localhost:8000/imprimir_denuncia/294'), 150,5, 120, 120, 'PNG');


//        $pdf->Text(20, 205, 'QRCODE H');

        $pdf->Output($pdf->FOLIO . '.pdf');

    }
}
