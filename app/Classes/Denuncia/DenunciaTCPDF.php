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






use TCPDF;
use TCPDF_FONTS;

define('FONT_ANDALEMONO', TCPDF_FONTS::addTTFfont(public_path().'/fonts/AndaleMono.php', 'TrueTypeUnicode', '', 32));
define('FONT_ARIALN', TCPDF_FONTS::addTTFfont(public_path().'/fonts/arialn.php', 'TrueTypeUnicode', '', 32));
define('FONT_AKODIA', TCPDF_FONTS::addTTFfont(public_path().'/fonts/Akodia.php', 'TrueTypeUnicode', '', 32));
define('FONT_LATO', TCPDF_FONTS::addTTFfont(public_path().'/fonts/Lato/Lato.php', 'TrueTypeUnicode', '', 32));
define('FONT_FREEMONO', TCPDF_FONTS::addTTFfont(public_path().'/fonts/freemono.php', 'TrueTypeUnicode', '', 32));

define('ATEMUN',config('atemun'));

class DenunciaTCPDF extends TCPDF{

    protected $alto        = 6;
    protected $aFT         = 205;
    protected $timex       = "";
    protected $title       = "";


    public function Header() {

        $this->setY(5);
        $this->setX(5);
        $this->SetTextColor(64,64,64);
        $this->SetFillColor(212,212,212);

        $this->SetFont(FONT_ARIALN,'I',16);
        $this->Image(ATEMUN['logo_reportes_encabezado'],5,5,80,20);
        $this->Cell(80,$this->alto,"","",0,"L");
        $this->Cell(150,$this->alto,env("NOMBRE_EMPRESA"),"",0,"L",true);

//            $this->SetFont('Arial','',7);
//            $this->SetFillColor(212,212,212);
//            $this->Cell(20,$this->alto,$this->timex,"",1,"R");
//            $this->setX(10);
//            $this->SetFont('Arial','B',10);
//            $this->Cell(25,$this->alto,"","",0,"L");
//            $this->Cell(150,$this->alto,utf8_decode("Av. México Núm. 2, Col. Del Bosque, Villahermosa, Tabasco. CP 86160"),"",0,"L");
//            $this->Cell(10,$this->alto,"FOLIO: ","",0,"R");
//            $this->SetFont('Arial','',8);
//            $this->SetFillColor(240,240,240);
//            $this->Cell(10,$this->alto,$this->folio,"",1,"R");
//            $this->setX(10);
//            $this->SetFont('Arial','B',14);
//            $this->Cell(25,$this->alto,"","",0,"L");
//            $this->Cell(145,$this->alto,utf8_decode($this->title),"",1,"C",true);
//            $this->Ln(5);
//            $this->Line(32,11,32,29);
//            $this->Line(32.5,11,32.5,29);
//            $this->Line(33,11,33,29);
//            $this->setX(10);
//            $this->SetFont('Arial','B',10);
//            $this->SetFillColor(192,192,192);
//            $this->Cell(25,$this->alto,"CLIENTE:",0,0,"R");
//            $this->Cell(10,$this->alto,$this->cliente_id,0,0,"R");
//            $this->SetFont('Arial','',10);
//            $this->Cell(105,$this->alto,utf8_decode(trim($this->cliente)),0,0,"L");
//            $this->SetFont('Arial','',6);
//            $this->Cell(25,$this->alto,utf8_decode($this->tipo_venta),0,0,"R");
//            $this->SetFont('Arial','',10);
//            $this->Cell(30,$this->alto,$this->status,0,1,"R");
//            $this->setX(10);
//            $this->SetFont('Arial','B',10);
//            $this->SetFillColor(192,192,192);
//            $this->Cell(25,$this->alto,"VENDEDOR:",0,0,"R");
//            $this->Cell(10,$this->alto,$this->vendedor_id,0,0,"R");
//            $this->SetFont('Arial','',10);
//            $this->Cell(105,$this->alto,utf8_decode(trim($this->vendedor)),0,0,"L");
//            $this->SetFont('Arial','B',6);
//            $this->Cell(25,$this->alto,utf8_decode("MÉTODO DE PAGO:"),0,0,"R");
//            $this->SetFont('Arial','',6);
//            $this->Cell(30,$this->alto,utf8_decode($this->metodo_pago.' '.$this->referencia),0,1,"R");
//            $this->Ln(5);
//            $this->setX(10);
//            $this->alto  = 10;
//            $this->SetFont('Arial','B',10);
//            $this->SetFillColor(192,192,192);
//            $this->Cell(25,$this->alto,"CANT.",1,0,"C",true);
//            $this->Cell(145,$this->alto,utf8_decode("DESCRIPCIÓN"),1,0,"L",true);
//            $this->Cell(25,$this->alto,"IMPORTE",1,1,"R",true);
        $this->alto  = 6;
        $this->setX(10);
    }




}
