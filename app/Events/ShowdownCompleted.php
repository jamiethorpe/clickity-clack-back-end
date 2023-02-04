<?php

namespace App\Events;

use App\Models\Showdown;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ShowdownCompleted implements ShouldBroadcast
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
        return new Channel("showdown.{$this->showdown->id}.completed");
    }

    public function broadcastAs()
    {
        return 'ShowdownCompleted';
    }

    public function broadcastWith()
    {
        return [
            'winner' => $this->showdown->user_id,
        ];
    }
}
