<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class IUQDenunciaEvent implements ShouldBroadcast{

    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $denuncia_id, $user_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($denuncia_id, $user_id){
        $this->denuncia_id = $denuncia_id;
        $this->user_id = $user_id;
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

    public function broadcastWith()
    {
        return [
            'denuncia_id' => $this->denuncia_id,
            'user_id'=> $this->user_id,
        ];
    }


}
