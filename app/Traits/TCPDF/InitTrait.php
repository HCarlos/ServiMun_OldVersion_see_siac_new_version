<?php
/**
 * Copyright (c) 2019. Realizado por Carlos Hidalgo
 */

namespace App\Traits\TCPDF;

use TCPDF_FONTS;

define('FONT_ANDALEMONO', TCPDF_FONTS::addTTFfont(public_path().'/fonts/AndaleMono.php', 'TrueTypeUnicode', '', 32));
define('FONT_ARIALN', TCPDF_FONTS::addTTFfont(public_path().'/fonts/arialn.php', 'TrueTypeUnicode', '', 32));
define('FONT_AKODIA', TCPDF_FONTS::addTTFfont(public_path().'/fonts/Akodia.php', 'TrueTypeUnicode', '', 32));
define('FONT_LATO', TCPDF_FONTS::addTTFfont(public_path().'/fonts/Lato/Lato.php', 'TrueTypeUnicode', '', 32));
define('FONT_FREEMONO', TCPDF_FONTS::addTTFfont(public_path().'/fonts/freemono.php', 'TrueTypeUnicode', '', 32));

define('FONT_AEALARABIYA', TCPDF_FONTS::addTTFfont(public_path().'/fonts/aealarabiya.php', 'TrueTypeUnicode', '', 32));
define('FONT_AEFURAT', TCPDF_FONTS::addTTFfont(public_path().'/fonts/aefurat.php', 'TrueTypeUnicode', '', 32));
define('FONT_DEJAVUSANS', TCPDF_FONTS::addTTFfont(public_path().'/fonts/dejavusans.php', 'TrueTypeUnicode', '', 32));
define('FONT_DEJAVUSANSCONDENSED', TCPDF_FONTS::addTTFfont(public_path().'/fonts/dejavusanscondensed.php', 'TrueTypeUnicode', '', 32));
define('FONT_DEJAVUSANSEXTRALIGHT', TCPDF_FONTS::addTTFfont(public_path().'/fonts/dejavusansextralight.php', 'TrueTypeUnicode', '', 32));
define('FONT_DEJAVUSANSMONO', TCPDF_FONTS::addTTFfont(public_path().'/fonts/dejavusansmono.php', 'TrueTypeUnicode', '', 32));
define('FONT_DEJAVUSERIF', TCPDF_FONTS::addTTFfont(public_path().'/fonts/dejavuserif.php', 'TrueTypeUnicode', '', 32));
define('FONT_DEJAVUSERIFCONDENSED', TCPDF_FONTS::addTTFfont(public_path().'/fonts/dejavuserifcondensed.php', 'TrueTypeUnicode', '', 32));
define('FONT_FREESANS', TCPDF_FONTS::addTTFfont(public_path().'/fonts/freesans.php', 'TrueTypeUnicode', '', 32));
define('FONT_PDFACOURIER', TCPDF_FONTS::addTTFfont(public_path().'/fonts/pdfacourier.php', 'TrueTypeUnicode', '', 32));
define('FONT_PDFAHELVETICA', TCPDF_FONTS::addTTFfont(public_path().'/fonts/pdfahelvetica.php', 'TrueTypeUnicode', '', 32));
define('FONT_PDFATIMES', TCPDF_FONTS::addTTFfont(public_path().'/fonts/pdfatimes.php', 'TrueTypeUnicode', '', 32));
define('FONT_TIMES', TCPDF_FONTS::addTTFfont(public_path().'/fonts/times.php', 'TrueTypeUnicode', '', 32));

define('ATEMUN',config('atemun'));

trait InitTrait
{

    public function Init()
    {
        $this->SetAutoPageBreak(TRUE, 0.1);
        $this->SetLeftMargin(5);
        $this->SetCreator(PDF_CREATOR);
        $this->SetAuthor('@DevCH');
        $this->SetTitle('Denuncia');
        $this->SetSubject('Ciudadana');
        $this->SetKeywords('SIAC, SIACGOB, ATENCION CIUDADANA');
        $this->setPrintHeader(true);
        $this->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 005', PDF_HEADER_STRING);
        $this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $this->setLanguageArray($l);
        }

    }

}