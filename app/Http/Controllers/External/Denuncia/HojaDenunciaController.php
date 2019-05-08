<?php

namespace App\Http\Controllers\External\Denuncia;

use App\Classes\Denuncia\DenunciaTCPDF;
use App\Http\Controllers\Controller;
use App\Models\Denuncias\Denuncia;
use Carbon\Carbon;

class HojaDenunciaController extends Controller
{


    public function imprimirDenuncia($Id=0){
        $timex  = Carbon::now()->format('d-m-Y H:i:s');
        $folio  = $Id;
        $alto   = 6;

        $pdf = new DenunciaTCPDF();
        $pdf->folio = $folio;
        $pdf->timex = $timex;

        $pdf->Init();
        $pdf->AddPage();

        $pdf->setCellPaddings(1, 1, 1, 1);


// Linea 1
        $pdf->setX(5);
        $pdf->Ln(30);
        $pdf->SetFont(FONT_ARIALN,'B',12);
        $pdf->SetTextColor(64,64,64);
        $pdf->SetFillColor(255,255,255);

        $den = Denuncia::find($Id);

        //$pdf->Cell(10,$alto,"LOTE",'LTRB',0,'C',true);
        $html = "<style> 
                        b { font-family: arial, sans-serif; }
                        p {text-align: justify;}
                 </style>";
        $html .= "<p>Estimado <b>{$den->ciudadano->FullName}</b> su preferencia. <br><br>";
        $html .= "
Ir a la navegación
Ir a la búsqueda
Ejemplo de Lorem ipsum

Lorem ipsum es el texto que se usa habitualmente en diseño gráfico en demostraciones de tipografías o de borradores de diseño para probar el diseño visual antes de insertar el texto final.

Aunque no posee actualmente fuentes para justificar sus hipótesis, el profesor de filología clásica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1​ Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.

El texto en sí no tiene sentido, aunque no es completamente aleatorio, sino que deriva de un texto de Cicerón en lengua latina, a cuyas palabras se les han eliminado sílabas o letras. El significado del texto no tiene importancia, ya que solo es una demostración o prueba, pero se inspira en la obra de Cicerón De finibus bonorum et malorum (Sobre los límites del bien y del mal) que comienza con:

    Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit2​

A pesar de estar extraído de ese escrito, el texto usado habitualmente[cita requerida] es: </p>";
        $pdf->WriteHTMLCell(200,$alto,$pdf->getX(),$pdf->getY(),$html,0,1);
        $pdf->Output();

    }
}
