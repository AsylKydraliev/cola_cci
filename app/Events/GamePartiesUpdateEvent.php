<?php

namespace App\Events;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Pusher\Pusher;
use Pusher\PusherException;

class GamePartiesUpdateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @throws PusherException|GuzzleException
     */
    public function __construct(public int $partyId)
    {
        $options = [
            'cluster' => 'ap2',
            'useTLS' => true
        ];
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data['party_id'] = $partyId;

        $pusher->trigger("gameParties.party.{$this->partyId}", 'game-parties-update', $data);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [];
    }
}
