<?php

namespace App\Events;

use App\Models\Round;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class RoundCompleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public Round $round)
    {
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel("showdown.{$this->round->showdown_id}.round.completed");
    }

    public function broadcastAs()
    {
        return 'RoundCompleted';
    }

    public function broadcastWith()
    {
        return [
            'combatants' => $this->round->performances->map(fn ($performance) => [
                'userId' => $performance->user_id,
                'duration' => $performance->duration,
                'winner' => $this->round->user_id === $performance->user_id,
            ])->toArray()
        ];
    }
}
