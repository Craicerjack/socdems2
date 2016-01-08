<?php

namespace App\Repositories;

use App\User;
use App\Box;

class BoxRepository {
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function getBoxes() {
        return Box::orderBy('created_at', 'asc')->get();
    }
}