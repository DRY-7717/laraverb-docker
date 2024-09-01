<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExampleEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.2
     */

    // public $message = 'hello world';

    // kalau pakai queue itu nanti channelnya tampil ada delaynya
    public string $queue = 'chat';

    public function __construct(protected User $user, protected Message $message)
    {
        //

    }


    // jadi disini bisa custom hasil array sesuka kita
    // kalau pakai ini isi parameter yang ada di func construct itu di ganti visibilitynya menjadi protected
    public function broadcastWith(): array
    {
        return [
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name
            ],

            'message' => [
                'id' => $this->message->id
            ]


        ];
    }

    public function broadcastQueue() : string{
        return 'chat';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('chat'),
        ];
    }
}
