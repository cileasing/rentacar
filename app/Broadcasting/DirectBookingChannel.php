<?php

namespace App\Broadcasting;

use App\User;

class DirectBookingChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\User  $user
     * @return array|bool
     */
    public function join(User $user, $booking)
    {
        return (int) $user->user_type === 2;
    }
}