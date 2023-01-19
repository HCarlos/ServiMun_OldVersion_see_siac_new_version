<?php

namespace App\Events;

use App\Http\Controllers\Funciones\FuncionesController;
use App\Models\Denuncias\Denuncia;
use App\User;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
//use Predis\Command\Redis\AUTH;
use Illuminate\Support\Facades\Auth;

class IUQDenunciaEvent implements ShouldBroadcast{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $denuncia_id, $user_id, $trigger_type, $msg, $icon, $status;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($denuncia_id, $user_id, $trigger_type){
        $this->denuncia_id  = $denuncia_id;
        $this->user_id      = $user_id;
        $this->trigger_type = $trigger_type;
        $this->status       = 204;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn(){
        return ['test-channel'];
    }

    public function broadcastAs()
    {
        return 'IUQDenunciaEvent';
    }

    public function broadcastWith(){
        $this->status = 200;
        $fecha = Carbon::now()->format('d-m-Y H:i:s');
        if ($this->trigger_type==0){
            $this->msg    =  strtoupper(Auth::user()->FullName)." ha CREADO una nueva denuncia: ".$this->denuncia_id."  ".$fecha;
            $this->icon   = "success";
            $triger_status = "CREAR";
        }else if ($this->trigger_type==1){
            $this->msg    = strtoupper(Auth::user()->fullname)." ha MODIFICADO la denuncia: ".$this->denuncia_id."  ".$fecha;
            $this->icon   = "info";
            $triger_status = "MODIFICAR";
        }else if ($this->trigger_type==2){
            $this->msg    = strtoupper(Auth::user()->fullname)." ha ELIMINADO la denuncia: ".$this->denuncia_id."  ".$fecha;
            $this->icon   = "warning";
            $triger_status = "ELIMINAR";
        }else{
            $this->msg    = "Hubo un Problema";
            $this->icon   = "error";
            $this->status = 204;
        }

        Log::alert("Evento: ".$this->msg);

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $Obj = DB::table('logs')->insert([
            'model_name'     => 'denuncias',
            'model_id'       => $this->denuncia_id,
            'trigger_status' => $triger_status,
            'trigger_type'   => $this->trigger_type,
            'message'        => $this->msg,
            'icon'           => $this->icon,
            'status'         => $this->status,
            'ip'             => FuncionesController::getIp(),
            'host'           => $ip,
            'fecha'          => now(),
            'user_id'        => $this->user_id,
        ]);

//        $filtrar_estas_curps = array('SAGA841106MTCLRL03', 'HERI791215MTCRZS05', 'SAAD761205MCSNLN06', 'DIHC990213HTCZRR02', 'VAOB880906MTCLPN04', 'JITM700108HTCMRN02', 'CAHC711129MTCRR08', 'CUOS740301HTCRLR04', 'MARN781030MTCRMT01', 'ROLD790608MTCDNY07', 'LOHE841013HTCP0003', 'HEMG881219HTCRRR09', 'CAHA730610MDFLRN06');
//        $User = User::find($this->user_id);
////        if (in_array(trim(strtoupper(Auth::user()->curp)), $filtrar_estas_curps)){
//        if (in_array(trim(strtoupper($User->curp)), $filtrar_estas_curps)){
//            $this->status = 204;
//        }

        if ( !Auth::user()->hasRole('Administrator|SysOp|USER_OPERATOR_ADMIN') ){
            $this->status = 204;
        }

        return [
            'denuncia_id'  => $this->denuncia_id,
            'user_id'      => $this->user_id,
            'trigger_type' => $this->trigger_type,
            'msg'          => $this->msg,
            'icon'         => $this->icon,
            'status'       => $this->status,
        ];
    }


}
