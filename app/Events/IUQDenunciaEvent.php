<?php

namespace App\Events;

use App\Models\Denuncias\Denuncia;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
//use Predis\Command\Redis\AUTH;
use Illuminate\Support\Facades\Auth;

class IUQDenunciaEvent implements ShouldBroadcast{

    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $denuncia_id, $user_id, $trigger_type, $msg, $icon;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($denuncia_id, $user_id, $trigger_type){
        $this->denuncia_id = $denuncia_id;
        $this->user_id = $user_id;
        $this->trigger_type = $trigger_type;
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

        if ($this->trigger_type==0){
            $this->msg =  strtoupper(Auth::user()->FullName)." ha CREADO una nueva denuncia: ".$this->denuncia_id;
            $this->icon = "success";
        }else if ($this->trigger_type==1){
            $this->msg = strtoupper(Auth::user()->fullname)." ha MODIFICADO la denuncia: ".$this->denuncia_id;
            $this->icon = "info";
        }else if ($this->trigger_type==2){
            $this->msg = strtoupper(Auth::user()->fullname)." ha ELIMINADO la denuncia: ".$this->denuncia_id;
            $this->icon = "warning";
        }else{
            $this->msg = "Hubo un Problema";
            $this->icon = "error";
        }

        Log::alert("Evento: ".$this->msg);

        return [
            'denuncia_id' => $this->denuncia_id,
            'user_id'=> $this->user_id,
            'trigger_type'=> $this->trigger_type,
            'msg' => $this->msg,
            'icon' => $this->icon,
        ];
    }


}
