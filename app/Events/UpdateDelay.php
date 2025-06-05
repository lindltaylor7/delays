<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateDelay implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data; // Datos que quieres enviar al frontend

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function broadcastOn()
    {
        // Canal privado para el usuario específico
        return new PrivateChannel('delays.' . $this->data['user_id']);
    }
}
