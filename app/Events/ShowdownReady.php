<?php

namespace App\Events;

use App\Http\Resources\ShowdownReadyResource;
use App\Models\Showdown;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ShowdownReady implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public Showdown $showdown)
    {
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel("showdown.{$this->showdown->id}.ready");
    }

    public function broadcastAs()
    {
        return 'ShowdownReady';
    }

    public function broadcastWith()
    {
        $this->showdown->load('combatants', 'rounds');
        $resource = new ShowdownReadyResource($this->showdown);
        return $resource->resolve();
    }
}
