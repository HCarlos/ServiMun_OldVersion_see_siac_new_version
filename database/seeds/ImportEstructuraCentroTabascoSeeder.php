<?php

use App\Models\Catalogos\Area;
use App\Models\Catalogos\Dependencia;
use App\Models\Catalogos\Servicio;
use App\Models\Catalogos\Subarea;
use Illuminate\Database\Seeder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class ImportEstructuraCentroTabascoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        @ini_set( 'upload_max_size' , '32768M' );
        @ini_set( 'post_max_size', '32768M');
        @ini_set( 'max_execution_time', '256000000' );
        @ini_set('memory_limit', '-1');

        Dependencia::query()->truncate();
        Area::query()->truncate();
        Subarea::query()->truncate();
        Servicio::query()->truncate();

//        $user = User::withTrashed()->where('id','>',13);
//        $user->forceDelete();
//        DB::statement("ALTER SEQUENCE users_id_seq RESTART WITH 14 ");


        $file = 'public/csv/dependencias.csv';
        $json_data = file_get_contents($file);
        $json_data = preg_split( "/\n/", $json_data );

        for ($x = 0; $x < count($json_data); $x++){
            try{

                $dupla = preg_split("/\t/", $json_data[$x], -1, PREG_SPLIT_NO_EMPTY);
                $arr = str_getcsv($dupla[0]);

                $area_id      = trim($arr[0]) == "" ? 0 : intval($arr[0]);
                $area      = trim($arr[0]) == "" ? 0 : intval($arr[0]);

                Log::alert('Registro Núm: '.$x);

            }catch (QueryException $e){
                Log::alert("Error en :: ".$e->getMessage());
                continue;
            }catch (Exception $e){
                Log::alert("Error en ".$e->getMessage());
                continue;
            }
        }





    }
}
