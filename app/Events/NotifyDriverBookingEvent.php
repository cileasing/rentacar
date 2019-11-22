<?php
namespace App\Events;
use App\User;
use App\DirectBooking;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
class NotifyDriverBookingEvent implements ShouldBroadcast
{
    
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $user;
    public $booking;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, DirectBooking $booking)
    {
        $this->user = $user;
        $this->booking = $booking;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('booking.'.$this->booking->id);
    }
    public function broadcastAs()
    {
        return 'NotifyDriverEvent';
    }
}