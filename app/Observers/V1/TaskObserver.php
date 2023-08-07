<?php

namespace App\Observers\V1;

use App\Models\Task;
use Auth;

class TaskObserver
{

  /**
     * Handle the Task "created" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function creating(Task $task)
    {
        $userId = Auth::id();
        $task['user_id'] = $userId;
    }
   
}
