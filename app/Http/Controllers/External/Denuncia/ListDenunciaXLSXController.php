<?php

namespace App\Http\Controllers\External\Denuncia;

use App\Models\Catalogos\Dependencia;
use App\Models\Catalogos\Domicilios\Ubicacion;
use App\Models\Catalogos\Estatu;
use App\Models\Catalogos\Origen;
use App\Models\Catalogos\Prioridad;
use App\Models\Catalogos\Servicio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Http\Controllers\Funciones\LoadTemplateExcel;
use App\User;
use Carbon\Carbon;
use Exception;

use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;



class ListDenunciaXLSXController extends Controller
{


    public function getListDenunciaXLSX(Request $request){
        ini_set('max_execution_time', 900);
//        $data = $request->only(['search','items']);
        $Items = $request->session()->get('items');

        $C0 = 6;
        $C = $C0;

        try {
            $file_external = trim(config("atemun.archivos.fmt_lista_denuncias"));
            //dd($file_external);
            $arrFE = explode('.',$file_external);
            $extension = Str::ucfirst($arrFE[1]);

            $archivo =  LoadTemplateExcel::getFileTemplate($file_external);
            $reader = IOFactory::createReader($extension);
            $spreadsheet = $reader->load($archivo);
            $sh = $spreadsheet->setActiveSheetIndex(0);

            $sh->setCellValue('K1', Carbon::now()->format('d-m-Y h:m:s'));
            foreach ($Items as $item){

                //dd($item);

                $ciudadano   = User::find($item->ciudadano_id);
                $prioridad   = Prioridad::find($item->prioridad_id);
                $origen      = Origen::find($item->origen_id);
                $dependencia = Dependencia::find($item->dependencia_id);
                $servicio    = Servicio::find($item->servicio_id);
                $ubicacion   = Ubicacion::find($item->ubicacion_id);
                $estatus     = Estatu::find($item->estatus_id);
                $creadopor   = User::find($item->creadopor_id);

                $fechaIngreso   = Carbon::parse($item->fecha_ingreso)->format('d-m-Y'); //Carbon::createFromFormat('d-m-Y', $item->fecha_nacimiento);
                $fechaLimite    = Carbon::parse($item->fecha_limite)->format('d-m-Y'); //Carbon::createFromFormat('d-m-Y', $item->fecha_nacimiento);
                $fechaEjecucion = Carbon::parse($item->fecha_ejecucion)->format('d-m-Y'); //Carbon::createFromFormat('d-m-Y', $item->fecha_nacimiento);

                $sh
                    ->setCellValue('A'.$C, $item->id)
                    ->setCellValue('B'.$C, $item->cantidad)
                    ->setCellValue('C'.$C, $fechaIngreso)
                    ->setCellValue('D'.$C, $fechaLimite)
                    ->setCellValue('E'.$C, $fechaEjecucion)
                    ->setCellValue('F'.$C, $item->descripcion)
                    ->setCellValue('G'.$C, $item->referencia)
                    ->setCellValue('H'.$C, $item->calle)
                    ->setCellValue('I'.$C, $item->num_ext)
                    ->setCellValue('J'.$C, $item->num_int)
                    ->setCellValue('K'.$C, $item->colonia)
                    ->setCellValue('L'.$C, $item->comunidad)
                    ->setCellValue('M'.$C, $item->ciudad)
                    ->setCellValue('N'.$C, $item->municipio)
                    ->setCellValue('O'.$C, $item->estado)
                    ->setCellValue('P'.$C, $prioridad->prioridad)
                    ->setCellValue('Q'.$C, $origen->origen)
                    ->setCellValue('R'.$C, $dependencia->dependencia)
                    ->setCellValue('S'.$C, $servicio->servicio)
                    ->setCellValue('T'.$C, $estatus->estatus)
                    ->setCellValue('U'.$C, $creadopor->fullName)
                    ->setCellValue('V'.$C, $ubicacion->ubicacion)

                    ->setCellValue('Z'.$C, $ciudadano->fullName);
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
