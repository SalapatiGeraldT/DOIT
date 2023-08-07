<?php

namespace App\Observers\V1;

use App\Models\User;

class UserObserver
{

    /**
     * Handle the Visitor "creating" event.
     *
     * @param  \App\Models\User  $visitor
     * @return void
     */
    public function creating(User $user)
    {
        $user->password = bcrypt($user->password);
    }

}
