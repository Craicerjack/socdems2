<?php

namespace App\Policies;

use App\User;
use App\Box;
use Illuminate\Auth\Access\HandlesAuthorization;

class BoxPolicy {
    use HandlesAuthorization;
    /**
     * Determine if the given user can delete the given task.
     *
     * @param  User  $user
     * @param  Task  $task
     * @return bool
     */
    public function destroy(User $user, Box $box) {
            // return $user->id === $task->user_id;
        // check if user is admin
        return true;
    }
}