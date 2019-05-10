<?php

namespace App\Http\Controllers\External;

use App\Http\Controllers\Funciones\LoadTemplateExcel;
use App\Models\Catalogos\Domicilios\Ubicacion;
use App\Models\Catalogos\Servicio;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ListModelXLSXController extends Controller
{

    public function getListModelXLSX($nModel){
        ini_set('max_execution_time', 900);
        $Model = null;
        switch ($nModel){
            case 1:
                $Model = Ubicacion::all();
                break;
            case 2:
                $Model = Servicio::all();
                break;
        }

        $C0 = 6;
        $C = $C0;

        try {
            $file_external = trim(config("atemun.archivos.fmt_lista_usuarios"));
            $arrFE = explode('.',$file_external);
            $extension = Str::ucfirst($arrFE[1]);

            $archivo =  LoadTemplateExcel::getFileTemplate($file_external);
            $reader = IOFactory::createReader($extension);
            $spreadsheet = $reader->load($archivo);
            $sh = $spreadsheet->setActiveSheetIndex(0);

            $sh->setCellValue('K1', Carbon::now()->format('d-m-Y h:m:s'));

            $attributes =$Model[0]->toArray();
            $row = 0;
            foreach ($attributes as $key=>$value){
                $sh->setCellValueByColumnAndRow($row,$C, $key);
                $row++;
            }
            $C++;
            foreach ($Model as $user){
                $attributes = $user->toArray();
                $row = 0;
                foreach ($attributes as $key=>$value) {
                        $sh->setCellValueByColumnAndRow($row, $C, $attributes[$key] );
                        $row++;
                }
                $C++;
            }

            $Cx = $C  - 1;
            $oVal = $sh->getCell('G1')->getValue();
            $sh->setCellValue('B'.$C, 'TOTAL DE REGISTROS')
                ->setCellValue('C'.$C, '=COUNT(A'.$C0.':A'.$Cx.')')
                ->setCellValue('G'.$C, $oVal);

            $sh->getStyle('A'.$C0.':G'.$C)->getFont()
                ->setName('Arial')
                ->setSize(8);

            $sh->getStyle('A'.$C.':G'.$C)->getFont()->setBold(true);

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="_'.$arrFE[0].'.'.$arrFE[1].'"');
            header('Cache-Control: max-age=0');
            header('Cache-Control: max-age=1');
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
            header('Cache-Control: cache, must-revalidate');
            header('Pragma: public');
            $writer = IOFactory::createWriter($spreadsheet, $extension);
            $writer->save('php://output');
            exit;

        } catch (Exception $e) {
            echo 'Ocurrio un error al intentar abrir el archivo ' . $e;
        }

    }


}
