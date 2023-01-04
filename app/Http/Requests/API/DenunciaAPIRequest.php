<?php

namespace App\Http\Requests\API;

use App\Classes\MessageAlertClass;
use App\Events\APIDenunciaEvent;
use App\Events\IUQDenunciaEvent;
use App\Http\Controllers\Funciones\FuncionesController;
use App\Models\Catalogos\Domicilios\Ubicacion;
use App\Models\Denuncias\Imagene;
use App\Models\Mobiles\Denunciamobile;
use App\Models\Mobiles\Imagemobile;
use App\Models\Mobiles\Serviciomobile;
use App\Rules\CurrentPassword;
use App\User;
use Carbon\Carbon;
use http\Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DenunciaAPIRequest extends FormRequest{

    protected $disk = 'mobile_denuncia';
    protected $F;


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'imagen' => ['required'],
            'denuncia' => ['required','min:5'],
            'latitud' => ['required','numeric','gt:0'],
            'longitud' => ['required','numeric','lt:0'],
        ];
    }

    public function messages()
    {
        return [
            'imagen.required' => 'Se requiere la :attribute.',
            'denuncia.required' => 'Se requiere la :attribute.',
            'denuncia.min' => 'La :attribute debe ser por lo menos de 5 caracteres.',
            'latitud.required' => 'Se requiere la :attribute.',
            'latitud.numeric' => 'La :attribute debe ser un valor numérico.',
            'latitud.gt' => 'La :attribute debe ser mayor que cero.',
            'longitud.required' => 'Se requiere la :attribute.',
            'longitud.numeric' => 'La :attribute debe ser un valor numérico.',
            'longitud.lt' => 'La :attribute debe ser menor que cero.',
        ];
    }

    public function attributes()
    {
        return [
            'imagen' => 'Imagen',
            'latitud' => 'Latitud',
            'longitud' => 'Longitud',
        ];
    }

    public function manage()
    {
        try {
            ini_set('max_execution_time', 300000);
            app()['cache']->forget('spatie.permission.cache');

            $Ser = Serviciomobile::all()->where("servicio",trim($this->servicio))->first();

            $filters =$this->ubicacion_google;
            $F           = new FuncionesController();
            $tsString    = $F->string_to_tsQuery( strtoupper($filters),' & ');
            $Ubi = Ubicacion::query()
                ->search($tsString)
                ->orderBy('id')
                ->first();

            $DenMob = Denunciamobile::create([
                'fecha'             => now(),
                'denuncia'          => strtoupper(trim($this->denuncia)),
                'tipo_mobile'       => strtoupper(trim($this->tipo_mobile)),
                'marca_mobile'      => strtoupper(trim($this->marca_mobile)),
                'serviciomobile_id' => $Ser ? $Ser->id : 1,
                'ubicacion_id'      => $Ubi ? $Ubi->id : $this->ubicacion_id,
                'ubicacion'         => strtoupper(trim($Ubi->Ubicacion ?? $this->ubicacion_google)),
                'ubicacion_google'  => strtoupper(trim($this->ubicacion_google)),
                'latitud'           => $this->latitud,
                'longitud'           => $this->longitud,
                'user_id'           => $this->user_id,
            ]);

            if ( $DenMob ){
                $this->manageImage($DenMob);
            }else{
                return ["status"=>0, "msg"=>"Ocurrió un error desconocido."];
            }

        } catch (QueryException $e) {
            return ["status"=>0, "msg"=>$e->getMessage()];
        }
        return $DenMob;
    }


    public function manageImage(Denunciamobile $denunciamobile){

        $this->F = new FuncionesController();

        try {


            $image = $this->imagen;
            $imageContent = $this->imageBase64Content($image);

            $file = $imageContent;
            $randomImageNameSingular = $this->randomImageNameSingular();
            $fileName = $randomImageNameSingular.'_'.$denunciamobile->id.'.png';
            $fileName2 = '_'.$randomImageNameSingular.'_'.$denunciamobile->id.'.png';
            $thumbnail = '_thumb_'.$randomImageNameSingular.'_'.$denunciamobile->id.'.png';
//            Storage::disk($this->disk)->put($fileName, File::get($file) );
            Storage::disk($this->disk)->put($fileName, $file );
            $this->F->fitImage( $file, $fileName2, 300, 300, true, $this->disk,"MOBILE_DENUNCIA_ROOT" );
            $this->F->fitImage( $file, $thumbnail, 128, 128, true, $this->disk,"MOBILE_DENUNCIA_ROOT", "png" );

            $fechaActual = Carbon::now()->format('Y-m-d h:m:s');
            $Item = [
                'fecha'             => $fechaActual,
                'user_id'           => $denunciamobile->user_id,
                'denunciamobile_id' => $denunciamobile->id,
                'root'              => 'mobile_denuncia/',
                'filename'          => $fileName,
                'filename_png'      => $fileName2,
                'filename_thumb'    => $thumbnail,
                'latitud'           => $denunciamobile->latitud,
                'longitud'          => $denunciamobile->longitud,
            ];
            $imm = Imagemobile::create($Item);
            if ($imm){
                $imm->denuncias()->attach($denunciamobile);
                $imm->users()->attach($denunciamobile->user_id);
                $denunciamobile->Imagemobiles()->attach($imm);
                $denunciamobile->ciudadanos()->attach($denunciamobile->user_id);
                event(new APIDenunciaEvent($denunciamobile->id, $denunciamobile->user_id,0));
                return $imm;
            }
            return ["status"=>0, "msg"=>"Error de imagen desconocido..."];

        }catch (Exception $e){
            return ["status"=>0, "msg"=>$e->getMessage()];
        }
        return $user;


    }


    private function imageBase64Content($image) {
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        return base64_decode($image);

    }

    private function randomImageName() {
        return Str::random(10) . '.' . 'png';
    }

    private function randomImageNameSingular() {
        return Str::random(25) ;
    }




    public function failedValidation(Validator $validator){
        $err = "";
        foreach ($validator->errors()->getMessages() as $ss){
            $err .= $err == "" ?  $ss[0] : " :: ". $ss[0];
        }
        throw new HttpResponseException(response()->json([
            'status' => 0,
            'msg'    => $err,
        ]));
    }



}
