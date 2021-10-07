<?php
/**
 * Copyright (c) 2019. Realizado por Carlos Hidalgo
 */

/**
 * Created by PhpStorm.
 * User: devch
 * Date: 20/03/19
 * Time: 11:29 AM
 */

namespace App\Classes\Denuncia;






use App\Traits\TCPDF\InitTrait;
use Carbon\Carbon;
use TCPDF;
use TCPDF_COLORS;
use TCPDF_STATIC;

class DenunciaTCPDF extends TCPDF{

    use InitTrait;

    protected $alto        = 6;
    public $timex          = "";
    protected $title       = "";
    public $folio          = 0;
    protected $date        = null;

    public function Header() {
        $this->date = new Carbon( $this->timex );
        $this->setY(15);
        $this->setX(5);
        $this->SetTextColor(64,64,64);
        $this->SetFillColor(212,212,212);

        $this->Image(ATEMUN['logo_reportes_encabezado'],5,15,60,19);

        $this->Cell(62,$this->alto,"","R",0,"L");
        $this->Cell(2,$this->alto,"","",0,"L");
        $this->SetFont(FONT_ARIALN,'',11);
        $this->Cell(120,$this->alto,env("NOMBRE_EMPRESA"),"",1,"L");

        $this->Cell(62,$this->alto,"","R",0,"L");
        $this->Cell(2,$this->alto,"","",0,"L");
        $this->SetFont(FONT_FREEMONO,'B',14);
        $this->Cell(120,$this->alto,env('INFO_TWO'),"",1,"L");

        $this->Cell(62,$this->alto,"","R",0,"L");
        $this->Cell(2,$this->alto,"","",0,"L");
        $this->SetFont(FONT_ARIALN,'',10);
        $this->Cell(85,$this->alto,"REPORTE CIUDADANO","",1,"L");
        $this->SetFont(FONT_FREEMONO,'B',10);
        $this->Cell(149,$this->alto,"","",0,"L");
        $this->Cell(22,$this->alto,"FOLIO: ","",0,"L");
        $this->SetFont(FONT_DEJAVUSANSMONO,'B',10);
        $this->SetTextColor(255,64,64);
        $this->Cell(25,$this->alto,"DAC-".str_pad($this->folio,6,'0',STR_PAD_LEFT)."-".$this->date->format('y'),"",1,"R");
        $this->SetTextColor(64,64,64);

        $this->SetFont(FONT_FREEMONO,'B',10);
        $this->Cell(149,$this->alto,"","",0,"L");
        $this->Cell(22,$this->alto,"FECHA: ","",0,"L");
        $this->SetFont(FONT_ARIALN,'',10);
        $this->Cell(25,$this->alto,$this->timex,"",1,"R");

        $this->alto  = 6;
        $this->setX(10);
    }



}
